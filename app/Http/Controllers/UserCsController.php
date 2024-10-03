<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\research;
use App\Models\college;
use App\Models\favorites;
use App\Models\requests;
use App\Models\view;
use Illuminate\Support\Facades\Auth;

class UserCsController extends Controller
{
    public function index(){
        $perPage = 12;
        $user = Auth::user();
        $requests = requests::where('status', 'pending')
        ->where('userId', $user->id);
        $userCsfiles = research::query()
        ->join('college', 'research.college', '=', 'college.id')
        ->select('research.*', 'college.college_name')
        ->where('college', '131')
        ->orderBy('filename', 'ASC');

    $userCsfiles = $userCsfiles->paginate($perPage);
    $colleges = college::all()->where('id', '131'); 

    $favoriteFilenames = favorites::where('user_id', $user->id)->pluck('filename')->toArray();
    
    foreach ($userCsfiles as $research) {
        $filename = $research->filename;

        // Check if the research item's filename exists in the favorites
        if (in_array($filename, $favoriteFilenames)) {
            $research->isInFavorites = true;
        } else {
            $research->isInFavorites = false;
        }
    }

    $collegeCsAlgo = view::query()
    ->join('research', 'research.filename', '=', 'view.filename')
    ->select('view.filename', 'research.college', view::raw('COUNT(DISTINCT view.userview_id) as userCount'))
    ->where('research.college', 131)
    ->groupBy('view.filename', 'research.college') 
    ->orderBy('userCount', 'DESC')
    ->get();
    return view('layouts.user-cs', compact('userCsfiles', 'colleges','collegeCsAlgo','requests','user'));
    
    }
    public function csAddToFavorites(Request $request, $id)
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
