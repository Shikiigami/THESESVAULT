<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\research;
use App\Models\college;
use App\Models\favorites;
use App\Models\view;
use Illuminate\Support\Facades\Auth;

class UserCeatController extends Controller
{
    public function index(){
        $perPage = 12;
        $user = Auth::user();
        $userCeatfiles = research::query()
        ->join('college', 'research.college', '=', 'college.id')
        ->select('research.*', 'college.college_name')
        ->where('college', '130')
        ->orderBy('filename', 'ASC');

    $userCeatfiles = $userCeatfiles->paginate($perPage);
    $colleges = college::all()->where('id', '130'); 
    $favoriteFilenames = favorites::where('user_id', $user->id)->pluck('filename')->toArray();
    
        foreach ($userCeatfiles as $research) {
            $filename = $research->filename;
    
            // Check if the research item's filename exists in the favorites
            if (in_array($filename, $favoriteFilenames)) {
                $research->isInFavorites = true;
            } else {
                $research->isInFavorites = false;
            }
        }

        $collegeCeatAlgo = view::query()
        ->join('research', 'research.filename', '=', 'view.filename')
        ->select('view.filename', 'research.college','research.callno', view::raw('COUNT(DISTINCT VIEW.userview_id) as user_count'))
        ->where('research.college', 130)
        ->groupBy('view.filename', 'research.college', 'research.callno') 
        ->orderBy('user_count', 'DESC')
        ->get();

     return view('layouts.user-ceat', compact('userCeatfiles', 'colleges','collegeCeatAlgo'));
    
    }

    public function ceatAddToFavorites(Request $request, $id)
    {
        $user = Auth::user(); // Get the authenticated user
        $research = research::find($id);
        if (!$research) {
            return redirect()->back()->with('error', 'Research item not found.');
        }

        $filename = $research->filename; 
        $existingFile = favorites::where('filename', $filename)
        ->where('user_id', $user->id)
        ->first();

        if ($existingFile) {
            return redirect()->back()->with('error', 'File already in Favorites');
        }  

        favorites::create([
            'user_id' => $user->id,
            'filename' => $research->filename,
        ]);
    
        return redirect()->back()->with('success', 'File added to Favorites');

    }  
}
