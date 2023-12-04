<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\research;
use App\Models\User;
use App\Models\history;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; 

class SearchController extends Controller
{

    public function search(Request $request)
    {
        $query = $request->input('search');
        
        $results = research::where('filename', 'like', '%' . $query . '%')
            ->orderBy('filename')
            ->take(4)
            ->pluck('filename')
            ->map(function ($filename) {
                return pathinfo($filename, PATHINFO_FILENAME);
            });
    
        // Retrieve and filter the user's search history
        $userHistory = history::where('user_id', Auth::id()) // Assuming 'user_id' is the user's ID column
            ->latest()
            ->take(3)
            ->pluck('search_name');
    
        $data = [
            'results' => $results,
            'history' => $userHistory, // Use the filtered user history
        ];
    
        return response()->json($data);
    }
    
    

}    
