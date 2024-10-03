<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\research;
use App\Models\history;
use App\Models\college;
use App\Models\Adviser;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Yaza\LaravelGoogleDriveStorage\Gdrive;
use Google\Service\Drive;




class ResearchController extends Controller
{
    public function index()
    {
        $files = research::orderBy('filename', 'ASC')->get();
        $colleges = college::all(); 
        $advisers = Adviser::orderBy('adviser_name', 'asc')->get();

        $result = DB::select("SELECT COLUMN_TYPE FROM information_schema.COLUMNS WHERE TABLE_NAME = 'users' AND COLUMN_NAME = 'interest'");
        $enumValues = [];
      if (!empty($result)) {
          preg_match('/^enum\((.*)\)$/', $result[0]->COLUMN_TYPE, $matches);
          if (isset($matches[1])) {
              $enumValues = explode(',', $matches[1]);
              $enumValues = array_map(function ($value) {
                  return trim($value, "'");
              }, $enumValues);
          }
      }
        return view('layouts.research-all', compact('files', 'colleges','advisers','enumValues'));
    }

    public function search(Request $request){

        $result = DB::select("SELECT COLUMN_TYPE FROM information_schema.COLUMNS WHERE TABLE_NAME = 'users' AND COLUMN_NAME = 'interest'");
        $enumValues = [];
      if (!empty($result)) {
          preg_match('/^enum\((.*)\)$/', $result[0]->COLUMN_TYPE, $matches);
          if (isset($matches[1])) {
              $enumValues = explode(',', $matches[1]);
              $enumValues = array_map(function ($value) {
                  return trim($value, "'");
              }, $enumValues);
          }
      }

        $searchHistory = new history();
        $searchHistory->search_name = $request->input('search');
        $searchHistory->user_id = auth()->user()->id;
        if ($request->has('submit')) {
            $searchHistory->save();    
        }  
        $searchQuery = $request->input('search');
        $userResearch = research::all();
        
        $advisers = Adviser::all();
        $colleges = college::all();
        $query = research::query()
            ->join('college', 'research.college', '=', 'college.id')
            ->select('research.*', 'college.college_name')
            ->orderBy('research.filename', 'ASC'); 
    
        if (strlen($searchQuery) > 0) {
            $query->where(function ($q) use ($searchQuery) {
                $q->where('research.id', $searchQuery)
                  ->orWhere('college.college_name', $searchQuery)
                  ->orWhere('research.callno','LIKE', '%' . $searchQuery . '%')
                  ->orWhere('research.date_published', $searchQuery)
                  ->orWhere('research.filename', 'LIKE', '%' . $searchQuery . '%')
                  ->orWhere('research.author', 'LIKE', '%' . $searchQuery . '%')
                  ->orWhere('research.adviser', 'LIKE', '%' . $searchQuery . '%')
                  ->orWhere('research.program', 'LIKE', '%' . $searchQuery . '%')
                  ->orWhere('research.campus', 'LIKE', '%' . $searchQuery . '%')
                  ->orWhere('research.tags', 'LIKE', '%' . $searchQuery . '%');
            });
        }
        $files = $query->paginate(6);
    
        if ($files->isEmpty()) {
            return redirect()->back()->with('error', 'No results found for your search.');
        }
    
        return view('layouts.research-all', compact('files', 'colleges', 'userResearch','advisers','enumValues'));
    }
    
    public function edit(string $id)
    {
        $file = research::findOrFail($id); 
        $colleges = college::all(); 
        $advisers = Adviser::all(); 
        return view('layouts.research-all', compact('file', 'colleges','advisers'));
    }
    
    public function create()
{
    $colleges = college::all(); 
    return view('layouts.research-all', compact('colleges'));
}
public function store(Request $request)

{
    $validator = Validator::make($request->all(), [
        'callno' => 'required|string',
        'filename' => 'required|mimes:pdf',
        'author' => 'required|string',
        'date_published' => 'required|date',
        'college' => 'required|integer',
        'adviser' => 'required|string',
        'campus' => 'required|in:Main Campus,Araceli,Balabac,Bataraza,"Brooke\'s Point",Coron,Cuyo,Dumaran,El Nido,Linapacan,Narra,Quezon,Rizal,Roxas,San Rafael,San Vicente,Sofronio Española,Taytay,Manalo',
        'citation' => 'nullable|string',
        'drive_link' => 'nullable|string',
        'approvalSheet' => 'required|mimes:pdf',
        'abstract' => 'required|mimes:pdf',
        'tags' => 'nullable|string',
        'privacy' => 'required|in:public,restricted'
    ]);

    if ($validator->fails()) {
        return redirect()->back()->with('error', 'Upload failed');
    }

    $uploadedFile = $request->file('filename');
    $filename = $uploadedFile->getClientOriginalName();
    $ext = $uploadedFile->getClientOriginalExtension();
    $approvalSheetFile = $request->file('approvalSheet');
    $approvalSheet = $approvalSheetFile->getClientOriginalName();
    $extApproval = $uploadedFile->getClientOriginalExtension();
    $abstractFile = $request->file('abstract');
    $abstract = $abstractFile->getClientOriginalName();
    $extAbstract = $uploadedFile->getClientOriginalExtension();

    if ($extApproval != 'pdf') {
        return redirect()->back()->with('error', 'Approval sheet must be pdf file');
    }
    if ($extAbstract  != 'pdf') {
        return redirect()->back()->with('error', 'Abstract must be pdf file');
    }
    if ($ext === 'pdf') {
        // Check if a file with the same filename already exists in the database
        $existingFile = research::where('filename', $filename)->first();
        if ($existingFile) {
            return redirect()->back()->with('error', ' File already exist!');
        }
        $callnoValue = $request->input('callno'); 
        $existingCallno = research::where('callno', $callnoValue)->first();
        if ($existingCallno) {
            return redirect()->back()->with('error', 'Callno already exists!');
        }
        $citation = $request->input('citation');
        if (empty($citation)) {
            $citation = null;
        }

        $folderId = 'ThesesVault';

            $googleDrive = Storage::disk('google');
            if (!$googleDrive->has($folderId)) {
                $this->createFolderOnGoogleDrive($folderId);
            }

            $googleDrivePath = $folderId . '/' . $filename;
            $googleDrive->put($googleDrivePath, file_get_contents($uploadedFile));

        $file = new research();
        $file->callno = $request->input('callno');
        $file->filename = $filename;
        $file->author = $request->input('author');
        $file->program = $request->input('program');
        $file->college = $request->input('college');
        $file->adviser = $request->input('adviser');
        $file->date_published = $request->input('date_published');
        $file->fieldname = $request->input('fieldname');
        $file->campus = $request->input('campus');
        $file->citation = $request->input('citation');
        $file->approvalSheet = $approvalSheet;
        $file->abstract = $abstract;
        $file->tags = $request->input('tags');
        $file->privacy = $request->input('privacy');


        // Move the uploaded file to the public/pdf directory
        $uploadedFile->move('storage/pdf', $filename);
        $approvalSheetFile->move('storage/approvalSheet', $approvalSheet);
        $abstractFile->move('storage/abstract', $abstract);
        $userAction = 'Upload'; 
            AuditLog::create([
                'adminId' => auth()->user()->id, 
                'action' => $userAction,
                'research' => $filename, 
                'action_date' => now(), 
            ]);
       
        // Save the file record in the database
        if ($request->has('submit')) {
            $file->save();
            return redirect()->back()->with('success', 'File Uploaded Successfully!');
        }      
    } 
    else {
        return redirect()->back()->with('error', 'Please upload a valid PDF file.');
    }
}
    public function update(Request $request, string $id)
    {
        $file = research::findOrFail($id); 

        $existingFile = research::where('callno', $request->input('callno'))
        ->where('id', '!=', $id)
        ->first();

        if ($existingFile) {
        return redirect()->back()->with('error', 'Callno already exists!');
}
        if ($request->hasFile('filename')) {
            $uploadedFile = $request->file('filename');
            $newFilename = $uploadedFile->getClientOriginalName();
            $ext = $uploadedFile->getClientOriginalExtension();

            $folderId = 'ThesesVault';

            $googleDrive = Storage::disk('google');
            if (!$googleDrive->has($folderId)) {
                $this->createFolderOnGoogleDrive($folderId);
            }

            $googleDrivePath = $folderId . '/' . $newFilename;
            $googleDrive->put($googleDrivePath, file_get_contents($uploadedFile));
            
            $existingFile = research::where('filename', $newFilename)->first();
            if ($existingFile) {
                return redirect()->back()->with('error', 'File already exist!');
            }
            if ($file->filename) {
                Storage::delete('storage\pdf' . $file->filename);
            }
            $uploadedFile->move('storage\pdf', $newFilename);
          
            $file->filename = $newFilename;

            if($ext != 'pdf'){
                return redirect()->back()->with('error', 'Please upload only pdf file');
            }
        }

        if($request->hasFile('approvalSheet')){
            $approvalSheetFile = $request->file('approvalSheet');
            $newApprovalSheet = $approvalSheetFile->getClientOriginalName();
            $approval_ext = $approvalSheetFile->getClientOriginalExtension();

            $approvalSheetFile->move('storage/approvalSheet', $newApprovalSheet);
            $file->approvalSheet = $newApprovalSheet;

            if($approval_ext != 'pdf'){
                return redirect()->back()->with('error', 'Approval sheet must be a pdf file');
            }
        }
        
        if($request->hasFile('abstract')){
            $abstractFile = $request->file('abstract');
            $newAbstract = $abstractFile->getClientOriginalName();
            $abstract_ext = $abstractFile->getClientOriginalExtension();

            $abstractFile->move('storage/abstract', $newAbstract);
            $file->abstract = $newAbstract;

            if($abstract_ext != 'pdf'){
                return redirect()->back()->with('error', 'Abstract must be a pdf file');
            }
        }
        // Update other fields
        $file->callno = $request->input('callno');
        $file->author = $request->input('author');
        $file->program = $request->input('program');
        $file->college = $request->input('college');
        $file->adviser = $request->input('adviser');
        $file->date_published = $request->input('date_published');
        $file->fieldname = $request->input('fieldname');
        $file->campus = $request->input('campus');
        $file->citation = $request->input('citation');
        $file->drive_link = $request->input('drive_link');
        $file->tags = $request->input('tags');
        $file->privacy = $request->input('privacy');
        $file->save();

        $userAction = 'Edit'; 
    
        AuditLog::create([
            'adminId' => auth()->user()->id,
            'admin_action' => $userAction,
            'research' => $file->filename,
            'action_date' => now(),
        ]);
        
        return redirect()->back()->with('success', 'File Updated Successfully!');
    }
    public function destroy(string $id)
    {

        $file = research::findOrFail($id);
        try {
            AuditLog::create([
                'adminId' => auth()->user()->id,
                'admin_action' => 'Delete',
                'research' => $file->filename,
                'action_date' => now(),
            ]);

        
            if ($file->filename) {
                $filePath = 'storage\pdf' . $file->filename; 

                if (Storage::exists($filePath)) {
                    Storage::delete($filePath);
                }
            }
            $file->delete();
            return redirect()->back()->with('success', 'File deleted successfully');
        } catch (\Exception $e) {
            Log::error("Error deleting file: {$e->getMessage()}");
            return redirect()->back()->with('error', 'Error deleting file');
        }
    }
    public function searchByDateRange(Request $request)
    {
        $startDate = Carbon::parse($request->input('start_date'));
        $endDate = Carbon::parse($request->input('end_date'));

        $files = research::whereBetween('date_published', [$startDate, $endDate])
            ->orderBy('date_published', 'asc')
            ->get();
    
        if ($files->isEmpty()) {
            return redirect()->back()->with('error', 'No data found in the specified date range.');
        }
    
        $colleges = college::all();
        $advisers = Adviser::orderBy('adviser_name', 'asc')->get();

        $pdf = Pdf::loadView('pdf.search-result', compact('files', 'colleges', 'advisers','startDate', 'endDate'));

        return $pdf->stream('search_results.pdf');
    }
    
    // College Index blade

public function cbaIndex(){
    $collegeName = 'College of Business and Accountancy Theses';
    $cbafiles = research::query()
    ->join('college', 'research.college', '=', 'college.id')
    ->join('adviser', 'research.adviser', '=', 'adviser.adviser_name')
    ->select('research.*', 'college.college_name','adviser.adviser_name')
    ->where('college', '132')
    ->orderBy('filename', 'ASC');

$cbafiles = $cbafiles->paginate();
$colleges = college::all()->where('id', '132');
$advisers = Adviser::all();

$result = DB::select("SELECT COLUMN_TYPE FROM information_schema.COLUMNS WHERE TABLE_NAME = 'users' AND COLUMN_NAME = 'interest'");
$enumValues = [];
if (!empty($result)) {
  preg_match('/^enum\((.*)\)$/', $result[0]->COLUMN_TYPE, $matches);
  if (isset($matches[1])) {
      $enumValues = explode(',', $matches[1]);
      $enumValues = array_map(function ($value) {
          return trim($value, "'");
      }, $enumValues);
  }
}
return view('colleges.cba-research', compact('cbafiles', 'colleges','advisers','enumValues','collegeName'));
}

public function cnhsIndex(){

$collegeName = 'College of Nursing and Health Sciences Theses';
$cnhsfiles = research::query()
->join('college', 'research.college', '=', 'college.id')
->join('adviser', 'research.adviser', '=', 'adviser.adviser_name')
->select('research.*', 'college.college_name','adviser.adviser_name')
->where('college', '133')
->orderBy('filename', 'ASC');

$cnhsfiles = $cnhsfiles->paginate();
$colleges = college::all()->where('id', '133');
$advisers = Adviser::all();

$result = DB::select("SELECT COLUMN_TYPE FROM information_schema.COLUMNS WHERE TABLE_NAME = 'users' AND COLUMN_NAME = 'interest'");
$enumValues = [];
if (!empty($result)) {
  preg_match('/^enum\((.*)\)$/', $result[0]->COLUMN_TYPE, $matches);
  if (isset($matches[1])) {
      $enumValues = explode(',', $matches[1]);
      $enumValues = array_map(function ($value) {
          return trim($value, "'");
      }, $enumValues);
  }
}
return view('colleges.cnhs-research', compact('cnhsfiles', 'colleges','advisers','enumValues','collegeName'));
}
public function cteIndex(){

    $collegeName = 'College of Teacher Education Theses';
    $ctefiles = research::query()
    ->join('college', 'research.college', '=', 'college.id')
    ->join('adviser', 'research.adviser', '=', 'adviser.adviser_name')
    ->select('research.*', 'college.college_name','adviser.adviser_name')
    ->where('college', '134')
    ->orderBy('filename', 'ASC');
    
    $ctefiles = $ctefiles->paginate();
    $colleges = college::all()->where('id', '134');
    $advisers = Adviser::all();
    
    $result = DB::select("SELECT COLUMN_TYPE FROM information_schema.COLUMNS WHERE TABLE_NAME = 'users' AND COLUMN_NAME = 'interest'");
    $enumValues = [];
    if (!empty($result)) {
      preg_match('/^enum\((.*)\)$/', $result[0]->COLUMN_TYPE, $matches);
      if (isset($matches[1])) {
          $enumValues = explode(',', $matches[1]);
          $enumValues = array_map(function ($value) {
              return trim($value, "'");
          }, $enumValues);
      }
    }
    return view('colleges.cte-research', compact('ctefiles', 'colleges','advisers','enumValues','collegeName'));
    }

    public function ccjeIndex(){

        $collegeName = 'College of Criminal Justice Education Theses';
        $ccjefiles = research::query()
        ->join('college', 'research.college', '=', 'college.id')
        ->join('adviser', 'research.adviser', '=', 'adviser.adviser_name')
        ->select('research.*', 'college.college_name','adviser.adviser_name')
        ->where('college', '135')
        ->orderBy('filename', 'ASC');
        
        $ccjefiles = $ccjefiles->paginate();
        $colleges = college::all()->where('id', '135');
        $advisers = Adviser::all();
        
        $result = DB::select("SELECT COLUMN_TYPE FROM information_schema.COLUMNS WHERE TABLE_NAME = 'users' AND COLUMN_NAME = 'interest'");
        $enumValues = [];
        if (!empty($result)) {
          preg_match('/^enum\((.*)\)$/', $result[0]->COLUMN_TYPE, $matches);
          if (isset($matches[1])) {
              $enumValues = explode(',', $matches[1]);
              $enumValues = array_map(function ($value) {
                  return trim($value, "'");
              }, $enumValues);
          }
        }
        return view('colleges.ccje-research', compact('ccjefiles', 'colleges','advisers','enumValues','collegeName'));
        }
        public function chtmIndex(){

            $collegeName = 'College of Hospitality Management and Tourism Theses';
            $chtmfiles = research::query()
            ->join('college', 'research.college', '=', 'college.id')
            ->join('adviser', 'research.adviser', '=', 'adviser.adviser_name')
            ->select('research.*', 'college.college_name','adviser.adviser_name')
            ->where('college', '136')
            ->orderBy('filename', 'ASC');
            
            $chtmfiles = $chtmfiles->paginate();
            $colleges = college::all()->where('id', '136');
            $advisers = Adviser::all();
            
            $result = DB::select("SELECT COLUMN_TYPE FROM information_schema.COLUMNS WHERE TABLE_NAME = 'users' AND COLUMN_NAME = 'interest'");
            $enumValues = [];
            if (!empty($result)) {
              preg_match('/^enum\((.*)\)$/', $result[0]->COLUMN_TYPE, $matches);
              if (isset($matches[1])) {
                  $enumValues = explode(',', $matches[1]);
                  $enumValues = array_map(function ($value) {
                      return trim($value, "'");
                  }, $enumValues);
              }
            }
            return view('colleges.chtm-research', compact('chtmfiles', 'colleges','advisers','enumValues','collegeName'));
            }
        public function cahIndex(){

            $collegeName = 'College of Arts and Humanities Theses';
            $cahfiles = research::query()
            ->join('college', 'research.college', '=', 'college.id')
            ->join('adviser', 'research.adviser', '=', 'adviser.adviser_name')
            ->select('research.*', 'college.college_name','adviser.adviser_name')
            ->where('college', '137')
            ->orderBy('filename', 'ASC');
            
            $cahfiles = $cahfiles->paginate();
            $colleges = college::all()->where('id', '137');
            $advisers = Adviser::all();
            
            $result = DB::select("SELECT COLUMN_TYPE FROM information_schema.COLUMNS WHERE TABLE_NAME = 'users' AND COLUMN_NAME = 'interest'");
            $enumValues = [];
            if (!empty($result)) {
                preg_match('/^enum\((.*)\)$/', $result[0]->COLUMN_TYPE, $matches);
                if (isset($matches[1])) {
                    $enumValues = explode(',', $matches[1]);
                    $enumValues = array_map(function ($value) {
                        return trim($value, "'");
                    }, $enumValues);
                }
            }
            return view('colleges.cah-research', compact('cahfiles', 'colleges','advisers','enumValues','collegeName'));
            }
        public function araceliIndex(){

            $collegeName = 'Arceli Campus Theses';
            $aracelifiles = research::query()
            ->join('college', 'research.college', '=', 'college.id')
            ->join('adviser', 'research.adviser', '=', 'adviser.adviser_name')
            ->select('research.*', 'college.college_name','adviser.adviser_name')
            ->where('college', '138')
            ->orderBy('filename', 'ASC');
            
            $aracelifiles = $aracelifiles->paginate();
            $colleges = college::all()->where('id', '138');
            $advisers = Adviser::all();
            
            $result = DB::select("SELECT COLUMN_TYPE FROM information_schema.COLUMNS WHERE TABLE_NAME = 'users' AND COLUMN_NAME = 'interest'");
            $enumValues = [];
            if (!empty($result)) {
                preg_match('/^enum\((.*)\)$/', $result[0]->COLUMN_TYPE, $matches);
                if (isset($matches[1])) {
                    $enumValues = explode(',', $matches[1]);
                    $enumValues = array_map(function ($value) {
                        return trim($value, "'");
                    }, $enumValues);
                }
            }
            return view('colleges.araceli-research', compact('aracelifiles', 'colleges','advisers','enumValues','collegeName'));
            }
        public function balabacIndex(){

            $collegeName = 'Balabac Campus Theses';
            $balabacfiles = research::query()
            ->join('college', 'research.college', '=', 'college.id')
            ->join('adviser', 'research.adviser', '=', 'adviser.adviser_name')
            ->select('research.*', 'college.college_name','adviser.adviser_name')
            ->where('college', '139')
            ->orderBy('filename', 'ASC');
            
            $balabacfiles = $balabacfiles->paginate();
            $colleges = college::all()->where('id', '139');
            $advisers = Adviser::all();
            
            $result = DB::select("SELECT COLUMN_TYPE FROM information_schema.COLUMNS WHERE TABLE_NAME = 'users' AND COLUMN_NAME = 'interest'");
            $enumValues = [];
            if (!empty($result)) {
                preg_match('/^enum\((.*)\)$/', $result[0]->COLUMN_TYPE, $matches);
                if (isset($matches[1])) {
                    $enumValues = explode(',', $matches[1]);
                    $enumValues = array_map(function ($value) {
                        return trim($value, "'");
                    }, $enumValues);
                }
            }
            return view('colleges.balabac-research', compact('balabacfiles', 'colleges','advisers','enumValues','collegeName'));
            }
            
        public function batarazaIndex(){

            $collegeName = 'Bataraza Campus Theses';
            $batarazafiles = research::query()
            ->join('college', 'research.college', '=', 'college.id')
            ->join('adviser', 'research.adviser', '=', 'adviser.adviser_name')
            ->select('research.*', 'college.college_name','adviser.adviser_name')
            ->where('college', '140')
            ->orderBy('filename', 'ASC');
            
            $batarazafiles = $batarazafiles->paginate();
            $colleges = college::all()->where('id', '140');
            $advisers = Adviser::all();
            
            $result = DB::select("SELECT COLUMN_TYPE FROM information_schema.COLUMNS WHERE TABLE_NAME = 'users' AND COLUMN_NAME = 'interest'");
            $enumValues = [];
            if (!empty($result)) {
                preg_match('/^enum\((.*)\)$/', $result[0]->COLUMN_TYPE, $matches);
                if (isset($matches[1])) {
                    $enumValues = explode(',', $matches[1]);
                    $enumValues = array_map(function ($value) {
                        return trim($value, "'");
                    }, $enumValues);
                }
            }
            return view('colleges.bataraza-research', compact('batarazafiles', 'colleges','advisers','enumValues','collegeName'));
            }
        public function brookespointIndex(){

            $collegeName = 'Brooke\'s Point Campus Theses';
            $brookespointfiles = research::query()
            ->join('college', 'research.college', '=', 'college.id')
            ->join('adviser', 'research.adviser', '=', 'adviser.adviser_name')
            ->select('research.*', 'college.college_name','adviser.adviser_name')
            ->where('college', '141')
            ->orderBy('filename', 'ASC');
            
            $brookespointfiles = $brookespointfiles->paginate();
            $colleges = college::all()->where('id', '141');
            $advisers = Adviser::all();
            
            $result = DB::select("SELECT COLUMN_TYPE FROM information_schema.COLUMNS WHERE TABLE_NAME = 'users' AND COLUMN_NAME = 'interest'");
            $enumValues = [];
            if (!empty($result)) {
                preg_match('/^enum\((.*)\)$/', $result[0]->COLUMN_TYPE, $matches);
                if (isset($matches[1])) {
                    $enumValues = explode(',', $matches[1]);
                    $enumValues = array_map(function ($value) {
                        return trim($value, "'");
                    }, $enumValues);
                }
            }
            return view('colleges.brookespoint-research', compact('brookespointfiles', 'colleges','advisers','enumValues','collegeName'));
            }
        public function coronIndex(){

            $collegeName = 'Coron Campus Theses';
            $coronfiles = research::query()
            ->join('college', 'research.college', '=', 'college.id')
            ->join('adviser', 'research.adviser', '=', 'adviser.adviser_name')
            ->select('research.*', 'college.college_name','adviser.adviser_name')
            ->where('college', '142')
            ->orderBy('filename', 'ASC');
            
            $coronfiles = $coronfiles->paginate();
            $colleges = college::all()->where('id', '142');
            $advisers = Adviser::all();
            
            $result = DB::select("SELECT COLUMN_TYPE FROM information_schema.COLUMNS WHERE TABLE_NAME = 'users' AND COLUMN_NAME = 'interest'");
            $enumValues = [];
            if (!empty($result)) {
                preg_match('/^enum\((.*)\)$/', $result[0]->COLUMN_TYPE, $matches);
                if (isset($matches[1])) {
                    $enumValues = explode(',', $matches[1]);
                    $enumValues = array_map(function ($value) {
                        return trim($value, "'");
                    }, $enumValues);
                }
            }
            return view('colleges.coron-research', compact('coronfiles', 'colleges','advisers','enumValues','collegeName'));
        }
        public function cuyoIndex(){

            $collegeName = 'PCAT Cuyo Campus Theses';
            $cuyofiles = research::query()
            ->join('college', 'research.college', '=', 'college.id')
            ->join('adviser', 'research.adviser', '=', 'adviser.adviser_name')
            ->select('research.*', 'college.college_name','adviser.adviser_name')
            ->where('college', '143')
            ->orderBy('filename', 'ASC');
    
            $cuyofiles = $cuyofiles->paginate();
            $colleges = college::all()->where('id', '143');
            $advisers = Adviser::all();
            
            $result = DB::select("SELECT COLUMN_TYPE FROM information_schema.COLUMNS WHERE TABLE_NAME = 'users' AND COLUMN_NAME = 'interest'");
            $enumValues = [];
            if (!empty($result)) {
                preg_match('/^enum\((.*)\)$/', $result[0]->COLUMN_TYPE, $matches);
                if (isset($matches[1])) {
                    $enumValues = explode(',', $matches[1]);
                    $enumValues = array_map(function ($value) {
                        return trim($value, "'");
                    }, $enumValues);
                }
            }
            return view('colleges.cuyo-research', compact('cuyofiles', 'colleges','advisers','enumValues','collegeName'));
        }
        public function dumaranIndex(){

            $collegeName = 'Dumaran Campus Theses';
            $dumaranfiles = research::query()
            ->join('college', 'research.college', '=', 'college.id')
            ->join('adviser', 'research.adviser', '=', 'adviser.adviser_name')
            ->select('research.*', 'college.college_name','adviser.adviser_name')
            ->where('college', '144')
            ->orderBy('filename', 'ASC');
    
            $dumaranfiles = $dumaranfiles->paginate();
            $colleges = college::all()->where('id', '144');
            $advisers = Adviser::all();
            
            $result = DB::select("SELECT COLUMN_TYPE FROM information_schema.COLUMNS WHERE TABLE_NAME = 'users' AND COLUMN_NAME = 'interest'");
            $enumValues = [];
            if (!empty($result)) {
                preg_match('/^enum\((.*)\)$/', $result[0]->COLUMN_TYPE, $matches);
                if (isset($matches[1])) {
                    $enumValues = explode(',', $matches[1]);
                    $enumValues = array_map(function ($value) {
                        return trim($value, "'");
                    }, $enumValues);
                }
            }
            return view('colleges.dumaran-research', compact('dumaranfiles', 'colleges','advisers','enumValues','collegeName'));
        }
        public function elnidoIndex(){

            $collegeName = 'El Nido Campus Theses';
            $elnidofiles = research::query()
            ->join('college', 'research.college', '=', 'college.id')
            ->join('adviser', 'research.adviser', '=', 'adviser.adviser_name')
            ->select('research.*', 'college.college_name','adviser.adviser_name')
            ->where('college', '145')
            ->orderBy('filename', 'ASC');
    
            $elnidofiles = $elnidofiles->paginate();
            $colleges = college::all()->where('id', '145');
            $advisers = Adviser::all();
            
            $result = DB::select("SELECT COLUMN_TYPE FROM information_schema.COLUMNS WHERE TABLE_NAME = 'users' AND COLUMN_NAME = 'interest'");
            $enumValues = [];
            if (!empty($result)) {
                preg_match('/^enum\((.*)\)$/', $result[0]->COLUMN_TYPE, $matches);
                if (isset($matches[1])) {
                    $enumValues = explode(',', $matches[1]);
                    $enumValues = array_map(function ($value) {
                        return trim($value, "'");
                    }, $enumValues);
                }
            }
            return view('colleges.elnido-research', compact('elnidofiles', 'colleges','advisers','enumValues','collegeName'));
        }

        public function linapacanIndex(){

            $collegeName = 'Linapacan Campus Theses';
            $linapacanfiles = research::query()
            ->join('college', 'research.college', '=', 'college.id')
            ->join('adviser', 'research.adviser', '=', 'adviser.adviser_name')
            ->select('research.*', 'college.college_name','adviser.adviser_name')
            ->where('college', '146')
            ->orderBy('filename', 'ASC');
    
            $linapacanfiles = $linapacanfiles->paginate();
            $colleges = college::all()->where('id', '146');
            $advisers = Adviser::all();
            
            $result = DB::select("SELECT COLUMN_TYPE FROM information_schema.COLUMNS WHERE TABLE_NAME = 'users' AND COLUMN_NAME = 'interest'");
            $enumValues = [];
            if (!empty($result)) {
                preg_match('/^enum\((.*)\)$/', $result[0]->COLUMN_TYPE, $matches);
                if (isset($matches[1])) {
                    $enumValues = explode(',', $matches[1]);
                    $enumValues = array_map(function ($value) {
                        return trim($value, "'");
                    }, $enumValues);
                }
            }
            return view('colleges.linapacan-research', compact('linapacanfiles', 'colleges','advisers','enumValues','collegeName'));
        }

        public function narraIndex(){

            $collegeName = 'Narra Campus Theses';
            $narrafiles = research::query()
            ->join('college', 'research.college', '=', 'college.id')
            ->join('adviser', 'research.adviser', '=', 'adviser.adviser_name')
            ->select('research.*', 'college.college_name','adviser.adviser_name')
            ->where('college', '147')
            ->orderBy('filename', 'ASC');
    
            $narrafiles = $narrafiles->paginate();
            $colleges = college::all()->where('id', '147');
            $advisers = Adviser::all();
            
            $result = DB::select("SELECT COLUMN_TYPE FROM information_schema.COLUMNS WHERE TABLE_NAME = 'users' AND COLUMN_NAME = 'interest'");
            $enumValues = [];
            if (!empty($result)) {
                preg_match('/^enum\((.*)\)$/', $result[0]->COLUMN_TYPE, $matches);
                if (isset($matches[1])) {
                    $enumValues = explode(',', $matches[1]);
                    $enumValues = array_map(function ($value) {
                        return trim($value, "'");
                    }, $enumValues);
                }
            }
            return view('colleges.narra-research', compact('narrafiles', 'colleges','advisers','enumValues','collegeName'));
        }

        public function quezonIndex(){

            $collegeName = 'Quezon Campus Theses';
            $quezonfiles = research::query()
            ->join('college', 'research.college', '=', 'college.id')
            ->join('adviser', 'research.adviser', '=', 'adviser.adviser_name')
            ->select('research.*', 'college.college_name','adviser.adviser_name')
            ->where('college', '148')
            ->orderBy('filename', 'ASC');
    
            $quezonfiles = $quezonfiles->paginate();
            $colleges = college::all()->where('id', '148');
            $advisers = Adviser::all();
            
            $result = DB::select("SELECT COLUMN_TYPE FROM information_schema.COLUMNS WHERE TABLE_NAME = 'users' AND COLUMN_NAME = 'interest'");
            $enumValues = [];
            if (!empty($result)) {
                preg_match('/^enum\((.*)\)$/', $result[0]->COLUMN_TYPE, $matches);
                if (isset($matches[1])) {
                    $enumValues = explode(',', $matches[1]);
                    $enumValues = array_map(function ($value) {
                        return trim($value, "'");
                    }, $enumValues);
                }
            }
            return view('colleges.quezon-research', compact('quezonfiles', 'colleges','advisers','enumValues','collegeName'));
        }

        public function rizalIndex(){

            $collegeName = 'Rizal Campus Theses';
            $rizalfiles = research::query()
            ->join('college', 'research.college', '=', 'college.id')
            ->join('adviser', 'research.adviser', '=', 'adviser.adviser_name')
            ->select('research.*', 'college.college_name','adviser.adviser_name')
            ->where('college', '149')
            ->orderBy('filename', 'ASC');
    
            $rizalfiles = $rizalfiles->paginate();
            $colleges = college::all()->where('id', '149');
            $advisers = Adviser::all();
            
            $result = DB::select("SELECT COLUMN_TYPE FROM information_schema.COLUMNS WHERE TABLE_NAME = 'users' AND COLUMN_NAME = 'interest'");
            $enumValues = [];
            if (!empty($result)) {
                preg_match('/^enum\((.*)\)$/', $result[0]->COLUMN_TYPE, $matches);
                if (isset($matches[1])) {
                    $enumValues = explode(',', $matches[1]);
                    $enumValues = array_map(function ($value) {
                        return trim($value, "'");
                    }, $enumValues);
                }
            }
            return view('colleges.rizal-research', compact('rizalfiles', 'colleges','advisers','enumValues','collegeName'));
        }

        public function roxasIndex(){

            $collegeName = 'Roxas Campus Theses';
            $roxasfiles = research::query()
            ->join('college', 'research.college', '=', 'college.id')
            ->join('adviser', 'research.adviser', '=', 'adviser.adviser_name')
            ->select('research.*', 'college.college_name','adviser.adviser_name')
            ->where('college', '150')
            ->orderBy('filename', 'ASC');
    
            $roxasfiles = $roxasfiles->paginate();
            $colleges = college::all()->where('id', '150');
            $advisers = Adviser::all();
            
            $result = DB::select("SELECT COLUMN_TYPE FROM information_schema.COLUMNS WHERE TABLE_NAME = 'users' AND COLUMN_NAME = 'interest'");
            $enumValues = [];
            if (!empty($result)) {
                preg_match('/^enum\((.*)\)$/', $result[0]->COLUMN_TYPE, $matches);
                if (isset($matches[1])) {
                    $enumValues = explode(',', $matches[1]);
                    $enumValues = array_map(function ($value) {
                        return trim($value, "'");
                    }, $enumValues);
                }
            }
            return view('colleges.roxas-research', compact('roxasfiles', 'colleges','advisers','enumValues','collegeName'));
        }

        public function sanrafaelIndex(){

            $collegeName = 'San Rafel Campus Theses';
            $sanrafaelfiles = research::query()
            ->join('college', 'research.college', '=', 'college.id')
            ->join('adviser', 'research.adviser', '=', 'adviser.adviser_name')
            ->select('research.*', 'college.college_name','adviser.adviser_name')
            ->where('college', '151')
            ->orderBy('filename', 'ASC');
    
            $sanrafaelfiles = $sanrafaelfiles->paginate();
            $colleges = college::all()->where('id', '151');
            $advisers = Adviser::all();
            
            $result = DB::select("SELECT COLUMN_TYPE FROM information_schema.COLUMNS WHERE TABLE_NAME = 'users' AND COLUMN_NAME = 'interest'");
            $enumValues = [];
            if (!empty($result)) {
                preg_match('/^enum\((.*)\)$/', $result[0]->COLUMN_TYPE, $matches);
                if (isset($matches[1])) {
                    $enumValues = explode(',', $matches[1]);
                    $enumValues = array_map(function ($value) {
                        return trim($value, "'");
                    }, $enumValues);
                }
            }
            return view('colleges.sanrafael-research', compact('sanrafaelfiles', 'colleges','advisers','enumValues','collegeName'));
        }
        public function sanvicenteIndex(){

            $collegeName = 'San Vicente Campus Theses';
            $sanvicentefiles = research::query()
            ->join('college', 'research.college', '=', 'college.id')
            ->join('adviser', 'research.adviser', '=', 'adviser.adviser_name')
            ->select('research.*', 'college.college_name','adviser.adviser_name')
            ->where('college', '152')
            ->orderBy('filename', 'ASC');
    
            $sanvicentefiles = $sanvicentefiles->paginate();
            $colleges = college::all()->where('id', '152');
            $advisers = Adviser::all();
            
            $result = DB::select("SELECT COLUMN_TYPE FROM information_schema.COLUMNS WHERE TABLE_NAME = 'users' AND COLUMN_NAME = 'interest'");
            $enumValues = [];
            if (!empty($result)) {
                preg_match('/^enum\((.*)\)$/', $result[0]->COLUMN_TYPE, $matches);
                if (isset($matches[1])) {
                    $enumValues = explode(',', $matches[1]);
                    $enumValues = array_map(function ($value) {
                        return trim($value, "'");
                    }, $enumValues);
                }
            }
            return view('colleges.sanvicente-research', compact('sanvicentefiles', 'colleges','advisers','enumValues','collegeName'));
        }

        public function sofronioIndex(){

            $collegeName = 'Sofronio Española Campus Theses';
            $sofroniofiles = research::query()
            ->join('college', 'research.college', '=', 'college.id')
            ->join('adviser', 'research.adviser', '=', 'adviser.adviser_name')
            ->select('research.*', 'college.college_name','adviser.adviser_name')
            ->where('college', '153')
            ->orderBy('filename', 'ASC');
    
            $sofroniofiles = $sofroniofiles->paginate();
            $colleges = college::all()->where('id', '153');
            $advisers = Adviser::all();
            
            $result = DB::select("SELECT COLUMN_TYPE FROM information_schema.COLUMNS WHERE TABLE_NAME = 'users' AND COLUMN_NAME = 'interest'");
            $enumValues = [];
            if (!empty($result)) {
                preg_match('/^enum\((.*)\)$/', $result[0]->COLUMN_TYPE, $matches);
                if (isset($matches[1])) {
                    $enumValues = explode(',', $matches[1]);
                    $enumValues = array_map(function ($value) {
                        return trim($value, "'");
                    }, $enumValues);
                }
            }
            return view('colleges.sofronio-research', compact('sofroniofiles', 'colleges','advisers','enumValues','collegeName'));
        }

        public function taytayIndex(){

            $collegeName = 'Taytay Campus Theses';
            $taytayfiles = research::query()
            ->join('college', 'research.college', '=', 'college.id')
            ->join('adviser', 'research.adviser', '=', 'adviser.adviser_name')
            ->select('research.*', 'college.college_name','adviser.adviser_name')
            ->where('college', '154')
            ->orderBy('filename', 'ASC');
    
            $taytayfiles = $taytayfiles->paginate();
            $colleges = college::all()->where('id', '154');
            $advisers = Adviser::all();
            
            $result = DB::select("SELECT COLUMN_TYPE FROM information_schema.COLUMNS WHERE TABLE_NAME = 'users' AND COLUMN_NAME = 'interest'");
            $enumValues = [];
            if (!empty($result)) {
                preg_match('/^enum\((.*)\)$/', $result[0]->COLUMN_TYPE, $matches);
                if (isset($matches[1])) {
                    $enumValues = explode(',', $matches[1]);
                    $enumValues = array_map(function ($value) {
                        return trim($value, "'");
                    }, $enumValues);
                }
            }
            return view('colleges.taytay-research', compact('taytayfiles', 'colleges','advisers','enumValues','collegeName'));
        }
    
        public function diplomaInTech(){

            $collegeName = 'Diploma in Teaching';
            $diplomaInTechfiles = research::query()
            ->join('college', 'research.college', '=', 'college.id')
            ->join('adviser', 'research.adviser', '=', 'adviser.adviser_name')
            ->select('research.*', 'college.college_name','adviser.adviser_name')
            ->where('research.program', 'Diploma in Teaching')
            ->orderBy('filename', 'ASC');
    
            $diplomaInTechfiles = $diplomaInTechfiles->paginate();
            $colleges = college::all()->where('id', '155');
            $advisers = Adviser::all();

            $dissertProgram = Research::whereIn('program', [
                'Diploma in Teaching',
                'Doctor of Education',
                'Master of Arts in Education',
                'Master of Arts in Teaching',
                'Master of Arts in Literature',
                'Master of Arts in Management',
                'Master in Business Administration',
                'Master of Science in Technopreneurship',
                'Master in Public Administration',
                'Master of Science in Environmental Management',
                'Master of Science in Nursing'
            ])
            ->orderBy('program', 'desc')
            ->get();



            
            $result = DB::select("SELECT COLUMN_TYPE FROM information_schema.COLUMNS WHERE TABLE_NAME = 'users' AND COLUMN_NAME = 'interest'");
            $enumValues = [];
            if (!empty($result)) {
                preg_match('/^enum\((.*)\)$/', $result[0]->COLUMN_TYPE, $matches);
                if (isset($matches[1])) {
                    $enumValues = explode(',', $matches[1]);
                    $enumValues = array_map(function ($value) {
                        return trim($value, "'");
                    }, $enumValues);
                }
            }
            return view('gradschool.diplomaInTech', compact('diplomaInTechfiles', 'colleges','advisers','enumValues','collegeName','dissertProgram'));
        }

        public function doctorEd(){

            $collegeName = 'Doctor of Education';
            $doctorEdfiles = research::query()
            ->join('college', 'research.college', '=', 'college.id')
            ->join('adviser', 'research.adviser', '=', 'adviser.adviser_name')
            ->select('research.*', 'college.college_name','adviser.adviser_name')
            ->where('research.program', 'Doctor of Education')
            ->orderBy('filename', 'ASC');
    
            $doctorEdfiles = $doctorEdfiles->paginate();
            $colleges = college::all()->where('id', '155');
            $advisers = Adviser::all();
            
            $result = DB::select("SELECT COLUMN_TYPE FROM information_schema.COLUMNS WHERE TABLE_NAME = 'users' AND COLUMN_NAME = 'interest'");
            $enumValues = [];
            if (!empty($result)) {
                preg_match('/^enum\((.*)\)$/', $result[0]->COLUMN_TYPE, $matches);
                if (isset($matches[1])) {
                    $enumValues = explode(',', $matches[1]);
                    $enumValues = array_map(function ($value) {
                        return trim($value, "'");
                    }, $enumValues);
                }
            }
            return view('gradschool.doctorEd', compact('doctorEdfiles', 'colleges','advisers','enumValues','collegeName'));
        }


        public function storeDissertation(Request $request)

{
    $validator = Validator::make($request->all(), [
        'callno' => 'required|string',
        'filename' => 'required|mimes:pdf',
        'author' => 'required|string',
        'date_published' => 'required|date',
        'college' => 'required|integer',
        'adviser' => 'required|string',
        'campus' => 'required|in:Main Campus,Araceli,Balabac,Bataraza,"Brooke\'s Point",Coron,Cuyo,Dumaran,El Nido,Linapacan,Narra,Quezon,Rizal,Roxas,San Rafael,San Vicente,Sofronio Española,Taytay,Manalo',
        'citation' => 'nullable|string',
        'drive_link' => 'nullable|string',
        'approvalSheet' => 'required|mimes:pdf',
        'abstract' => 'required|mimes:pdf',
        'tags' => 'nullable|string',
        'privacy' => 'required|in:public,restricted'
    ]);

    if ($validator->fails()) {
        return redirect()->back()->with('error', 'Upload failed');
    }

    $uploadedFile = $request->file('filename');
    $filename = $uploadedFile->getClientOriginalName();
    $ext = $uploadedFile->getClientOriginalExtension();
    $approvalSheetFile = $request->file('approvalSheet');
    $approvalSheet = $approvalSheetFile->getClientOriginalName();
    $extApproval = $uploadedFile->getClientOriginalExtension();
    $abstractFile = $request->file('abstract');
    $abstract = $abstractFile->getClientOriginalName();
    $extAbstract = $uploadedFile->getClientOriginalExtension();

    if ($extApproval != 'pdf') {
        return redirect()->back()->with('error', 'Approval sheet must be pdf file');
    }
    if ($extAbstract  != 'pdf') {
        return redirect()->back()->with('error', 'Abstract must be pdf file');
    }
    if ($ext === 'pdf') {
        // Check if a file with the same filename already exists in the database
        $existingFile = research::where('filename', $filename)->first();
        if ($existingFile) {
            return redirect()->back()->with('error', ' File already exist!');
        }
        $callnoValue = $request->input('callno'); 
        $existingCallno = research::where('callno', $callnoValue)->first();
        if ($existingCallno) {
            return redirect()->back()->with('error', 'Callno already exists!');
        }
        $citation = $request->input('citation');
        if (empty($citation)) {
            $citation = null;
        }

        $parentFolder = 'ThesesVault';
        $childFolder = 'Dissertations';

        $folderId = $parentFolder . '/' . $childFolder;
        $googleDrive = Storage::disk('google');

        $googleDrivePath = $folderId . '/' . $filename;
        $googleDrive->put($googleDrivePath, file_get_contents($uploadedFile));


        $file = new research();
        $file->callno = $request->input('callno');
        $file->filename = $filename;
        $file->author = $request->input('author');
        $file->program = $request->input('program');
        $file->college = $request->input('college');
        $file->adviser = $request->input('adviser');
        $file->date_published = $request->input('date_published');
        $file->fieldname = $request->input('fieldname');
        $file->campus = $request->input('campus');
        $file->citation = $request->input('citation');
        $file->approvalSheet = $approvalSheet;
        $file->abstract = $abstract;
        $file->tags = $request->input('tags');
        $file->privacy = $request->input('privacy');


        // Move the uploaded file to the public/pdf directory
        $approvalSheetFile->move('storage/approvalSheet', $approvalSheet);
        $abstractFile->move('storage/abstract', $abstract);
        $userAction = 'Upload'; 
            AuditLog::create([
                'adminId' => auth()->user()->id, 
                'action' => $userAction,
                'research' => $filename, 
                'action_date' => now(), 
            ]);
       
        // Save the file record in the database
        if ($request->has('submit')) {
            $file->save();
            return redirect()->back()->with('success', 'File Uploaded Successfully!');
        }      
    } 
    else {
        return redirect()->back()->with('error', 'Please upload a valid PDF file.');
    }
}

public function updateDissertation(Request $request, string $id)
    {
        $file = research::findOrFail($id); 

        $existingFile = research::where('callno', $request->input('callno'))
        ->where('id', '!=', $id)
        ->first();

        if ($existingFile) {
        return redirect()->back()->with('error', 'Callno already exists!');
}
        if ($request->hasFile('filename')) {
            $uploadedFile = $request->file('filename');
            $newFilename = $uploadedFile->getClientOriginalName();
            $ext = $uploadedFile->getClientOriginalExtension();

            $parentFolder = 'ThesesVault';
            $childFolder = 'Dissertations';
    
            $folderId = $parentFolder . '/' . $childFolder;
            $googleDrive = Storage::disk('google');
    
            $googleDrivePath = $folderId . '/' . $newFilename;
            $googleDrive->put($googleDrivePath, file_get_contents($uploadedFile));
            
            $existingFile = research::where('filename', $newFilename)->first();
            if ($existingFile) {
                return redirect()->back()->with('error', 'File already exist!');
            }
            if ($file->filename) {
                Storage::delete('storage\pdf' . $file->filename);
            }
            $file->filename = $newFilename;

            if($ext != 'pdf'){
                return redirect()->back()->with('error', 'Please upload only pdf file');
            }
        }

        if($request->hasFile('approvalSheet')){
            $approvalSheetFile = $request->file('approvalSheet');
            $newApprovalSheet = $approvalSheetFile->getClientOriginalName();
            $approval_ext = $approvalSheetFile->getClientOriginalExtension();

            $approvalSheetFile->move('storage/approvalSheet', $newApprovalSheet);
            $file->approvalSheet = $newApprovalSheet;

            if($approval_ext != 'pdf'){
                return redirect()->back()->with('error', 'Approval sheet must be a pdf file');
            }
        }
        
        if($request->hasFile('abstract')){
            $abstractFile = $request->file('abstract');
            $newAbstract = $abstractFile->getClientOriginalName();
            $abstract_ext = $abstractFile->getClientOriginalExtension();

            $abstractFile->move('storage/abstract', $newAbstract);
            $file->abstract = $newAbstract;

            if($abstract_ext != 'pdf'){
                return redirect()->back()->with('error', 'Abstract must be a pdf file');
            }
        }
        // Update other fields
        $file->callno = $request->input('callno');
        $file->author = $request->input('author');
        $file->program = $request->input('program');
        $file->college = $request->input('college');
        $file->adviser = $request->input('adviser');
        $file->date_published = $request->input('date_published');
        $file->fieldname = $request->input('fieldname');
        $file->campus = $request->input('campus');
        $file->citation = $request->input('citation');
        $file->drive_link = $request->input('drive_link');
        $file->tags = $request->input('tags');
        $file->privacy = $request->input('privacy');
        $file->save();

        $userAction = 'Edit'; 
    
        AuditLog::create([
            'adminId' => auth()->user()->id,
            'admin_action' => $userAction,
            'research' => $file->filename,
            'action_date' => now(),
        ]);
        
        return redirect()->back()->with('success', 'File Updated Successfully!');
    }
    
}
