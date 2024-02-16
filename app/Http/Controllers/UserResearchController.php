<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\research;
use App\Models\college;
use App\Models\view;
use App\Models\history;
use GuzzleHttp\Client;
use App\Models\favorites;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;


class UserResearchController extends Controller
{
    public function index()
    {
        $userResearch = research::orderBy('filename')->paginate(9);
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
            ->orderBy('research.filename', 'ASC');
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
         $googleResults = $this->fetchGoogleResults($searchQuery);
        if ($userResearch->isEmpty() && empty($googleResults)) {
            return redirect()->back()->with('error', 'No results found for your search.');
        }
        
        return view('layouts.user-research-all', compact('userResearch', 'colleges', 'googleResults'));
    }
    private function fetchGoogleResults($searchQuery, $startIndex = 11)
    {
        $apiKey = 'AIzaSyBp7uTVB64wq6vVErOnlxxUahe_W0wPHdQ';
        $cx = 'a33edfa8aed5b437a';
    
        $client = new Client();
        $apiUrl = "https://www.googleapis.com/customsearch/v1?q={$searchQuery}&key={$apiKey}&cx={$cx}&start={$startIndex}";
    
        try {
            $response = $client->get($apiUrl);
            $data = json_decode($response->getBody(), true);
    
            return $data['items'] ?? [];
        } catch (\Exception $e) {
            return [];
        }
    }

private function paginateResults($results, $perPage)
{
    $page = request()->get('page', 1);
    $offset = ($page - 1) * $perPage;
    
    return new LengthAwarePaginator(
        $results->slice($offset, $perPage),
        $results->count(),
        $perPage,
        $page,
        ['path' => url()->current()]
    );
}
    
}
