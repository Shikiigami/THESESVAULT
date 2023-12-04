<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\research;
use App\Models\history;
use App\Models\college;
use App\Models\Adviser;
use App\Models\auditLog;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\PDF;
use Carbon\Carbon;


class ResearchController extends Controller
{
    public function index()
    {
        $files = research::select('id','callno', 'filename', 'author','program','date_published', 'college', 'adviser','fieldname','campus','citation','drive_link')
        ->orderBy('filename', 'ASC')->paginate();
        $colleges = college::all(); 
        $advisers = Adviser::orderBy('adviser_name', 'asc')->get();
        return view('layouts.research-all', compact('files', 'colleges','advisers'));
    }

    public function search(Request $request){

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
            ->orderBy('research.filename', 'ASC'); // Specify 'research.filename' to avoid ambiguity
    
        if (strlen($searchQuery) > 0) {
            $query->where(function ($q) use ($searchQuery) {
                $q->where('research.id', $searchQuery)
                  ->orWhere('college.college_name', $searchQuery)
                  ->orWhere('research.callno', $searchQuery)
                  ->orWhere('research.date_published', $searchQuery)
                  ->orWhere('research.filename', 'LIKE', '%' . $searchQuery . '%')
                  ->orWhere('research.author', 'LIKE', '%' . $searchQuery . '%')
                  ->orWhere('research.adviser', 'LIKE', '%' . $searchQuery . '%')
                  ->orWhere('research.program', 'LIKE', '%' . $searchQuery . '%')
                  ->orWhere('research.campus', 'LIKE', '%' . $searchQuery . '%');
            });
        }
    
        $files = $query->paginate(6);
    
        if ($files->isEmpty()) {
            return redirect()->back()->with('error', 'No results found for your search.');
        }
    
        return view('layouts.research-all', compact('files', 'colleges', 'userResearch','advisers'));
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
        'program' => 'required|in:BS Information Technology,BS Computer Science,BS Medical Biology,BS Environmental Science,BS Marine Biology,BS Civil Engineering,BS Mechanical Engineering,BS Petroleum Engineering,BS Electrical Engineering,BS Architecture',
        'date_published' => 'required|date',
        'college' => 'required|integer',
        'adviser' => 'required|string',
        'fieldname' => 'required|in:Business,Technology,Education',
        'campus' => 'required|in:Main Campus,Araceli,Balabac,Bataraza,"Brooke\'s Point",Coron,Cuyo,Dumaran,El Nido,Linapacan,Narra,Quezon,Rizal,Roxas,San Rafael,San Vicente,Sofronio Española,Taytay',
        'citation'=>'required|string',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->with('error', 'Upload failed');
    }

    $uploadedFile = $request->file('filename');
    $filename = $uploadedFile->getClientOriginalName();
    $ext = $uploadedFile->getClientOriginalExtension();

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

        // Save input data to the database
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
        $file->drive_link = $request->input('drive_link');

        // Move the uploaded file to the public/pdf directory
        $uploadedFile->move('storage/pdf', $filename);
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

            $existingFile = research::where('filename', $newFilename)->first();
            if ($existingFile) {
                return redirect()->back()->with('error', 'File already exist!');
            }
            // Delete old file if exists
            if ($file->filename) {
                Storage::delete('storage\pdf' . $file->filename);
            }
            $uploadedFile->move('storage\pdf', $newFilename);
            $file->filename = $newFilename;

            if($ext != 'pdf'){
                return redirect()->back()->with('error', 'Please upload only pdf file');
            
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
        
        $file->save();

        $userAction = 'Edit'; 
    
        auditLog::create([
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
    
        // Load the view with the data
        $pdf = PDF::loadView('pdf.search-result', compact('files', 'colleges', 'advisers','startDate', 'endDate'));

        return $pdf->stream('search_results.pdf');
    }

}
