<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\research;
use App\Models\favorites;
use App\Models\view;
use App\Models\Adviser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavoritesController extends Controller
{
    public function index(){
        $user_id =  Auth::user()->id; // Assuming you want to get the user's ID
        $userFavorites = DB::table('favorites')
        ->join('research', 'favorites.filename', '=', 'research.filename')
        ->join('college', 'research.college', '=', 'college.id')
        ->join('adviser', 'research.adviser', '=', 'adviser.adviser_name')
        ->where('user_id', $user_id)
        ->select('favorites.*', 'college.college_name', 'research.*', 'adviser.adviser_name')
        ->paginate(6);
        return view('layouts.user-favorites', compact('userFavorites', 'user_id'));
    }
    
    public function addToFavorites(Request $request, $id)
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
            return redirect()->back()->with('error', 'File already in Bookmarks');
        }  

        favorites::create([
            'user_id' => $user->id,
            'filename' => $research->filename,
        ]);
    
        return redirect()->back()->with('success', 'File added to Bookmarks.');

    }  

    public function favfetchResearch($id)
    {
        $research = research::find($id);
    
        if (!$research) {
            return response()->json(['error' => 'Research not found'], 404);
        }
    
        $filenameWithoutExtension = pathinfo($research->filename, PATHINFO_FILENAME);
    
        $collegeName = ($research->college == 130) ? 'CEAT' : (($research->college == 131) ? 'CS' : 'N/A');
        
        $modalContent = '<p><b>Title: </b>' . $filenameWithoutExtension . '<br>';
        $modalContent .= '<b>Authors: </b>' . $research->author . '<br>';
        $modalContent .= '<b>Published Date: </b>' . $research->date_published . '<br>';
        $modalContent .= '<b>College: </b>' . $collegeName . '<br>';
        $modalContent .= '<b>Adviser: </b>' . $research->adviser . '<br>';
        $modalContent .= '</p>';
    
        return response()->json([
            'filename' => $research->filename,
            'modalContent' => $modalContent,
        ]);
    }

    public function destroy(string $fid){
        $favorites= favorites::findOrFail($fid);
        $favorites->delete();
        return redirect()->back()->with('success', 'File remove from Bookmarks Successfully');
    }
}