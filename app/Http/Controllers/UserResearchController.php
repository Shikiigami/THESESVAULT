<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\research;
use App\Models\college;
use App\Models\view;
use App\Models\history;
use App\Models\download;
use App\Models\favorites;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserResearchController extends Controller
{
    public function index()
    {
        $userResearch = research::orderBy('filename')->paginate(6);
        $user = Auth::user();
        // Fetch the filenames of research items in user's favorites
        $favoriteFilenames = favorites::where('user_id', $user->id)->pluck('filename')->toArray();
    
        foreach ($userResearch as $research) {
            $filename = $research->filename;
    
            // Check if the research item's filename exists in the favorites
            if (in_array($filename, $favoriteFilenames)) {
                $research->isInFavorites = true;
            } else {
                $research->isInFavorites = false;
            }
        }

            
        return view('layouts.user-research-all', compact('userResearch'));
    }
    
    
    public function viewAndSave($filename)
{
    $research = research::where('filename', $filename)->first();

    if (!$research) {
        return abort(404);
    }

    // Check if the research has a drive link
    if (!$research->drive_link) {
        return redirect()->back()->with('error', 'No drive link provided for this research.');
    }

    // Create a new view record
    $view = new view();
    $view->filename = $filename;
    $view->research_id = $research->id;
    $view->userview_id = Auth::id();
    $view->viewed_at = now();
    $view->research_college = $research->college;
    $view->user_college = Auth::user()->college_id;
    $view->save();

    // Redirect the user to the drive_link associated with the research
    return redirect()->away($research->drive_link);
}
  
    
    public function search(Request $request){

        $rules = [
            'search' => 'required|string|min:1',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $searchHistory = new history();
        $searchHistory->search_name = $request->input('search');
        $searchHistory->user_id = auth()->user()->id;
        if ($request->has('submit')) {
            $searchHistory->save();    
        }     
        $searchQuery = $request->input('search');
        $userResearch = research::all();
        
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
                  ->orWhere('research.fieldname', 'LIKE', '%' . $searchQuery . '%');
            });
        }
    
        $userResearch = $query->paginate(6);
    
        if ($userResearch->isEmpty()) {
            return redirect()->back()->with('error', 'No results found for your search.');
        }
    
        return view('layouts.user-research-all', compact('userResearch', 'colleges', 'userResearch'));
    
    }

    public function recordDownload(Request $request, $filename)
    {
        $user = Auth::user();

        $download = new download();
        $download->user_did = $user->id;
        $download->dl_filename = $filename;
        $download->save();

        // Return the file for download
        $file = public_path('storage/pdf/' . $filename);
        return response()->download($file);
    }
    
}
