<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\research;
use App\Models\history;
use App\Models\Adviser;
use App\Models\college;
use Illuminate\Support\Facades\DB;


class CategorySearchController extends Controller
{
    public function searchByAuthor(Request $request){
        $searchHistory = new history();
        $searchHistory->search_name = $request->input('search_author');
        $searchHistory->user_id = auth()->user()->id;
        if ($request->has('submit')) {
            $searchHistory->save();    
        }  
        $searchAuthor = $request->input('search_author');
        $userResearch = research::all();
        
        $advisers = Adviser::all();
        $colleges = college::all();
        $query = research::query()
            ->join('college', 'research.college', '=', 'college.id')
            ->select('research.*', 'college.college_name')
            ->orderBy('research.filename', 'ASC'); // Specify 'research.filename' to avoid ambiguity
    
        if (strlen($searchAuthor) > 0) {
            $query->where(function ($q) use ($searchAuthor) {
                $q->where('research.author',  'LIKE', '%'. $searchAuthor . '%');
            });
        }
    
        $files = $query->paginate(6);
    
        if ($files->isEmpty()) {
            return redirect()->back()->with('error', 'No results found for your search.');
        }
    
        return view('layouts.research-all', compact('files', 'colleges', 'userResearch','advisers'));
    }

    public function searchByAdviser(Request $request){
        $searchHistory = new history();
        $searchHistory->search_name = $request->input('search_adviser');
        $searchHistory->user_id = auth()->user()->id;
        if ($request->has('submit')) {
            $searchHistory->save();    
        }  
        $searchAdviser = $request->input('search_adviser');
        $userResearch = research::all();
        
        $advisers = Adviser::all();
        $colleges = college::all();
        $query = research::query()
            ->join('college', 'research.college', '=', 'college.id')
            ->select('research.*', 'college.college_name')
            ->orderBy('research.filename', 'ASC'); 
    
        if (strlen($searchAdviser) > 0) {
            $query->where(function ($q) use ($searchAdviser) {
                $q->where('research.adviser',  'LIKE', '%'. $searchAdviser . '%');
            });
        }
    
        $files = $query->paginate(6);
    
        if ($files->isEmpty()) {
            return redirect()->back()->with('error', 'No results found for your search.');
        }
    
        return view('layouts.research-all', compact('files', 'colleges', 'userResearch','advisers'));
    }

    public function searchByCollege(Request $request){
        $searchHistory = new history();
        $searchHistory->search_name = $request->input('search_college');
        $searchHistory->user_id = auth()->user()->id;
        if ($request->has('submit')) {
            $searchHistory->save();    
        }  
        $searchCollege = $request->input('search_college');
        $userResearch = research::all();
        
        $advisers = Adviser::all();
        $colleges = college::all();
        $query = research::query()
            ->join('college', 'research.college', '=', 'college.id')
            ->select('research.*', 'college.college_name')
            ->orderBy('research.filename', 'ASC'); 
    
        if (strlen($searchCollege) > 0) {
            $query->where(function ($q) use ($searchCollege) {
                $q->where('college.college_name',  'LIKE', '%'. $searchCollege . '%')
                  ->orWhere('college.id', 'LIKE',  '%' . $searchCollege .'%');
            });
        }
    
        $files = $query->paginate(6);
    
        if ($files->isEmpty()) {
            return redirect()->back()->with('error', 'No results found for your search.');
        }
    
        return view('layouts.research-all', compact('files', 'colleges', 'userResearch','advisers'));
    }

    public function searchByProgram(Request $request){
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
        $searchHistory->search_name = $request->input('search_program');
        $searchHistory->user_id = auth()->user()->id;
        if ($request->has('submit')) {
            $searchHistory->save();    
        }  
        $searchProgram = $request->input('search_program');
        $userResearch = research::all();
        
        $advisers = Adviser::all();
        $colleges = college::all();
        $query = research::query()
            ->join('college', 'research.college', '=', 'college.id')
            ->select('research.*', 'college.college_name')
            ->orderBy('research.filename', 'ASC'); 
    
        if (strlen($searchProgram) > 0) {
            $query->where(function ($q) use ($searchProgram) {
                $q->where('research.program',  'LIKE', '%'. $searchProgram . '%');
            });
        }
    
        $files = $query->paginate(6);
    
        if ($files->isEmpty()) {
            return redirect()->back()->with('error', 'No results found for your search.');
        }
    
        return view('layouts.research-all', compact('files', 'colleges', 'userResearch','advisers', 'enumValues'));
    }
}
