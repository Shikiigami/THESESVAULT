<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\research;
use App\Models\college;
use App\Models\view;
use App\Models\history;
use GuzzleHttp\Client;
use App\Models\favorites;
use App\Models\requests;
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
        $requests = requests::where('status', 'pending')
                            ->where('userId', $user->id);
        $favoriteFilenames = favorites::where('user_id', $user->id)->pluck('filename')->toArray();
    
        foreach ($userResearch as $research) {
            $filename = $research->filename;
    
            if (in_array($filename, $favoriteFilenames)) {
                $research->isInFavorites = true;
            } else {
                $research->isInFavorites = false;
            }
        } 
        return view('layouts.user-research-all', compact('userResearch','requests','user'));
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
                  ->orWhere('research.fieldname', 'LIKE', '%' . $searchQuery . '%')
                  ->orWhere('research.tags', 'LIKE', '%' . $searchQuery . '%');
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

public function userCbaindex(){

    $collegeUserName = "College of Business and Accountancy Theses";
    $perPage = 12;
    $user = Auth::user();
    $requests = requests::where('status', 'pending')
    ->where('userId', $user->id);
    $userfiles = research::query()
    ->join('college', 'research.college', '=', 'college.id')
    ->select('research.*', 'college.college_name')
    ->where('research.college', '132')
    ->orderBy('filename', 'ASC');

    $userfiles = $userfiles->paginate($perPage);
    $colleges = college::all()->where('id', '132'); 

$favoriteFilenames = favorites::where('user_id', $user->id)->pluck('filename')->toArray();

foreach ($userfiles as $research) {
    $filename = $research->filename;

    // Check if the research item's filename exists in the favorites
    if (in_array($filename, $favoriteFilenames)) {
        $research->isInFavorites = true;
    } else {
        $research->isInFavorites = false;
    }
}
$collegeUsersAlgo = view::query()
->join('research', 'research.filename', '=', 'view.filename')
->select('view.filename', 'research.college', view::raw('COUNT(DISTINCT view.userview_id) as userCount'))
->where('research.college', 132)
->groupBy('view.filename', 'research.college') 
->orderBy('userCount', 'DESC')
->get();
return view('userColleges.user-cba', compact('userfiles', 'colleges','collegeUsersAlgo','requests','user', 'collegeUserName'));
}

public function userCnhsindex(){

    $collegeUserName = "College of Nursing and Health Sciences Theses";
    $perPage = 12;
    $user = Auth::user();
    $requests = requests::where('status', 'pending')
    ->where('userId', $user->id);
    $userfiles = research::query()
    ->join('college', 'research.college', '=', 'college.id')
    ->select('research.*', 'college.college_name')
    ->where('research.college', '133')
    ->orderBy('filename', 'ASC');

    $userfiles = $userfiles->paginate($perPage);
    $colleges = college::all()->where('id', '133'); 

$favoriteFilenames = favorites::where('user_id', $user->id)->pluck('filename')->toArray();

foreach ($userfiles as $research) {
    $filename = $research->filename;
    if (in_array($filename, $favoriteFilenames)) {
        $research->isInFavorites = true;
    } else {
        $research->isInFavorites = false;
    }
}
$collegeUsersAlgo = view::query()
->join('research', 'research.filename', '=', 'view.filename')
->select('view.filename', 'research.college', view::raw('COUNT(DISTINCT view.userview_id) as userCount'))
->where('research.college', 132)
->groupBy('view.filename', 'research.college') 
->orderBy('userCount', 'DESC')
->get();
return view('userColleges.user-cnhs', compact('userfiles', 'colleges','collegeUsersAlgo','requests','user', 'collegeUserName'));
}

public function userCteindex(){

    $collegeUserName = "College of Teacher Education";
    $perPage = 12;
    $user = Auth::user();
    $requests = requests::where('status', 'pending')
    ->where('userId', $user->id);
    $userfiles = research::query()
    ->join('college', 'research.college', '=', 'college.id')
    ->select('research.*', 'college.college_name')
    ->where('research.college', '134')
    ->orderBy('filename', 'ASC');

    $userfiles = $userfiles->paginate($perPage);
    $colleges = college::all()->where('id', '134'); 

$favoriteFilenames = favorites::where('user_id', $user->id)->pluck('filename')->toArray();

foreach ($userfiles as $research) {
    $filename = $research->filename;
    if (in_array($filename, $favoriteFilenames)) {
        $research->isInFavorites = true;
    } else {
        $research->isInFavorites = false;
    }
}
$collegeUsersAlgo = view::query()
->join('research', 'research.filename', '=', 'view.filename')
->select('view.filename', 'research.college', view::raw('COUNT(DISTINCT view.userview_id) as userCount'))
->where('research.college', 134)
->groupBy('view.filename', 'research.college') 
->orderBy('userCount', 'DESC')
->get();
return view('userColleges.user-cte', compact('userfiles', 'colleges','collegeUsersAlgo','requests','user', 'collegeUserName'));
}

public function userCcjeindex(){

    $collegeUserName = "College of Criminal Justice Education";
    $perPage = 12;
    $user = Auth::user();
    $requests = requests::where('status', 'pending')
    ->where('userId', $user->id);
    $userfiles = research::query()
    ->join('college', 'research.college', '=', 'college.id')
    ->select('research.*', 'college.college_name')
    ->where('research.college', '135')
    ->orderBy('filename', 'ASC');

    $userfiles = $userfiles->paginate($perPage);
    $colleges = college::all()->where('id', '135'); 

$favoriteFilenames = favorites::where('user_id', $user->id)->pluck('filename')->toArray();

foreach ($userfiles as $research) {
    $filename = $research->filename;
    if (in_array($filename, $favoriteFilenames)) {
        $research->isInFavorites = true;
    } else {
        $research->isInFavorites = false;
    }
}
$collegeUsersAlgo = view::query()
->join('research', 'research.filename', '=', 'view.filename')
->select('view.filename', 'research.college', view::raw('COUNT(DISTINCT view.userview_id) as userCount'))
->where('research.college', 135)
->groupBy('view.filename', 'research.college') 
->orderBy('userCount', 'DESC')
->get();
return view('userColleges.user-ccje', compact('userfiles', 'colleges','collegeUsersAlgo','requests','user', 'collegeUserName'));
}
public function userChtmindex(){

    $collegeUserName = "College of Hospitality Management and Tourism";
    $perPage = 12;
    $user = Auth::user();
    $requests = requests::where('status', 'pending')
    ->where('userId', $user->id);
    $userfiles = research::query()
    ->join('college', 'research.college', '=', 'college.id')
    ->select('research.*', 'college.college_name')
    ->where('research.college', '136')
    ->orderBy('filename', 'ASC');

    $userfiles = $userfiles->paginate($perPage);
    $colleges = college::all()->where('id', '136'); 

$favoriteFilenames = favorites::where('user_id', $user->id)->pluck('filename')->toArray();

foreach ($userfiles as $research) {
    $filename = $research->filename;
    if (in_array($filename, $favoriteFilenames)) {
        $research->isInFavorites = true;
    } else {
        $research->isInFavorites = false;
    }
}
$collegeUsersAlgo = view::query()
->join('research', 'research.filename', '=', 'view.filename')
->select('view.filename', 'research.college', view::raw('COUNT(DISTINCT view.userview_id) as userCount'))
->where('research.college', 136)
->groupBy('view.filename', 'research.college') 
->orderBy('userCount', 'DESC')
->get();
return view('userColleges.user-chtm', compact('userfiles', 'colleges','collegeUsersAlgo','requests','user', 'collegeUserName'));
}

public function userCahindex(){

    $collegeUserName = "College of Arts and Humanities";
    $perPage = 12;
    $user = Auth::user();
    $requests = requests::where('status', 'pending')
    ->where('userId', $user->id);
    $userfiles = research::query()
    ->join('college', 'research.college', '=', 'college.id')
    ->select('research.*', 'college.college_name')
    ->where('research.college', '137')
    ->orderBy('filename', 'ASC');

    $userfiles = $userfiles->paginate($perPage);
    $colleges = college::all()->where('id', '137'); 

$favoriteFilenames = favorites::where('user_id', $user->id)->pluck('filename')->toArray();

foreach ($userfiles as $research) {
    $filename = $research->filename;
    if (in_array($filename, $favoriteFilenames)) {
        $research->isInFavorites = true;
    } else {
        $research->isInFavorites = false;
    }
}
$collegeUsersAlgo = view::query()
->join('research', 'research.filename', '=', 'view.filename')
->select('view.filename', 'research.college', view::raw('COUNT(DISTINCT view.userview_id) as userCount'))
->where('research.college', 137)
->groupBy('view.filename', 'research.college') 
->orderBy('userCount', 'DESC')
->get();
return view('userColleges.user-cah', compact('userfiles', 'colleges','collegeUsersAlgo','requests','user', 'collegeUserName'));
}

public function araceliIndex(){

    $collegeUserName = "Araceli Campus Theses";
    $perPage = 12;
    $user = Auth::user();
    $requests = requests::where('status', 'pending')
    ->where('userId', $user->id);
    $userfiles = research::query()
    ->join('college', 'research.college', '=', 'college.id')
    ->select('research.*', 'college.college_name')
    ->where('research.college', '138')
    ->orderBy('filename', 'ASC');

    $userfiles = $userfiles->paginate($perPage);
    $colleges = college::all()->where('id', '138'); 

$favoriteFilenames = favorites::where('user_id', $user->id)->pluck('filename')->toArray();

foreach ($userfiles as $research) {
    $filename = $research->filename;
    if (in_array($filename, $favoriteFilenames)) {
        $research->isInFavorites = true;
    } else {
        $research->isInFavorites = false;
    }
}
$collegeUsersAlgo = view::query()
->join('research', 'research.filename', '=', 'view.filename')
->select('view.filename', 'research.college', view::raw('COUNT(DISTINCT view.userview_id) as userCount'))
->where('research.college', 138)
->groupBy('view.filename', 'research.college') 
->orderBy('userCount', 'DESC')
->get();
return view('userColleges.user-araceli', compact('userfiles', 'colleges','collegeUsersAlgo','requests','user', 'collegeUserName'));
}

public function balabacIndex(){

    $collegeUserName = "Balabac Campus Theses";
    $perPage = 12;
    $user = Auth::user();
    $requests = requests::where('status', 'pending')
    ->where('userId', $user->id);
    $userfiles = research::query()
    ->join('college', 'research.college', '=', 'college.id')
    ->select('research.*', 'college.college_name')
    ->where('research.college', '139')
    ->orderBy('filename', 'ASC');

    $userfiles = $userfiles->paginate($perPage);
    $colleges = college::all()->where('id', '139'); 

$favoriteFilenames = favorites::where('user_id', $user->id)->pluck('filename')->toArray();

foreach ($userfiles as $research) {
    $filename = $research->filename;
    if (in_array($filename, $favoriteFilenames)) {
        $research->isInFavorites = true;
    } else {
        $research->isInFavorites = false;
    }
}
$collegeUsersAlgo = view::query()
->join('research', 'research.filename', '=', 'view.filename')
->select('view.filename', 'research.college', view::raw('COUNT(DISTINCT view.userview_id) as userCount'))
->where('research.college', 139)
->groupBy('view.filename', 'research.college') 
->orderBy('userCount', 'DESC')
->get();
return view('userColleges.user-balabac', compact('userfiles', 'colleges','collegeUsersAlgo','requests','user', 'collegeUserName'));
}

public function batarazaIndex(){

    $collegeUserName = "Bataraza Campus Theses";
    $perPage = 12;
    $user = Auth::user();
    $requests = requests::where('status', 'pending')
    ->where('userId', $user->id);
    $userfiles = research::query()
    ->join('college', 'research.college', '=', 'college.id')
    ->select('research.*', 'college.college_name')
    ->where('research.college', '140')
    ->orderBy('filename', 'ASC');

    $userfiles = $userfiles->paginate($perPage);
    $colleges = college::all()->where('id', '140'); 

$favoriteFilenames = favorites::where('user_id', $user->id)->pluck('filename')->toArray();

foreach ($userfiles as $research) {
    $filename = $research->filename;
    if (in_array($filename, $favoriteFilenames)) {
        $research->isInFavorites = true;
    } else {
        $research->isInFavorites = false;
    }
}
$collegeUsersAlgo = view::query()
->join('research', 'research.filename', '=', 'view.filename')
->select('view.filename', 'research.college', view::raw('COUNT(DISTINCT view.userview_id) as userCount'))
->where('research.college', 140)
->groupBy('view.filename', 'research.college') 
->orderBy('userCount', 'DESC')
->get();
return view('userColleges.user-bataraza', compact('userfiles', 'colleges','collegeUsersAlgo','requests','user', 'collegeUserName'));
}

public function brookespointIndex(){

    $collegeUserName = "Brookes's Point Campus Theses";
    $perPage = 12;
    $user = Auth::user();
    $requests = requests::where('status', 'pending')
    ->where('userId', $user->id);
    $userfiles = research::query()
    ->join('college', 'research.college', '=', 'college.id')
    ->select('research.*', 'college.college_name')
    ->where('research.college', '141')
    ->orderBy('filename', 'ASC');

    $userfiles = $userfiles->paginate($perPage);
    $colleges = college::all()->where('id', '141'); 

$favoriteFilenames = favorites::where('user_id', $user->id)->pluck('filename')->toArray();

foreach ($userfiles as $research) {
    $filename = $research->filename;
    if (in_array($filename, $favoriteFilenames)) {
        $research->isInFavorites = true;
    } else {
        $research->isInFavorites = false;
    }
}
$collegeUsersAlgo = view::query()
->join('research', 'research.filename', '=', 'view.filename')
->select('view.filename', 'research.college', view::raw('COUNT(DISTINCT view.userview_id) as userCount'))
->where('research.college', 141)
->groupBy('view.filename', 'research.college') 
->orderBy('userCount', 'DESC')
->get();
return view('userColleges.user-brookespoint', compact('userfiles', 'colleges','collegeUsersAlgo','requests','user', 'collegeUserName'));
}

public function coronIndex(){

    $collegeUserName = "Coron Campus Theses";
    $perPage = 12;
    $user = Auth::user();
    $requests = requests::where('status', 'pending')
    ->where('userId', $user->id);
    $userfiles = research::query()
    ->join('college', 'research.college', '=', 'college.id')
    ->select('research.*', 'college.college_name')
    ->where('research.college', '142')
    ->orderBy('filename', 'ASC');

    $userfiles = $userfiles->paginate($perPage);
    $colleges = college::all()->where('id', '142'); 

$favoriteFilenames = favorites::where('user_id', $user->id)->pluck('filename')->toArray();

foreach ($userfiles as $research) {
    $filename = $research->filename;
    if (in_array($filename, $favoriteFilenames)) {
        $research->isInFavorites = true;
    } else {
        $research->isInFavorites = false;
    }
}
$collegeUsersAlgo = view::query()
->join('research', 'research.filename', '=', 'view.filename')
->select('view.filename', 'research.college', view::raw('COUNT(DISTINCT view.userview_id) as userCount'))
->where('research.college', 142)
->groupBy('view.filename', 'research.college') 
->orderBy('userCount', 'DESC')
->get();
return view('userColleges.user-coron', compact('userfiles', 'colleges','collegeUsersAlgo','requests','user', 'collegeUserName'));
}

public function cuyoIndex(){

    $collegeUserName = "PCAT Cuyo Campus Theses";
    $perPage = 12;
    $user = Auth::user();
    $requests = requests::where('status', 'pending')
    ->where('userId', $user->id);
    $userfiles = research::query()
    ->join('college', 'research.college', '=', 'college.id')
    ->select('research.*', 'college.college_name')
    ->where('research.college', '143')
    ->orderBy('filename', 'ASC');

    $userfiles = $userfiles->paginate($perPage);
    $colleges = college::all()->where('id', '143'); 

$favoriteFilenames = favorites::where('user_id', $user->id)->pluck('filename')->toArray();

foreach ($userfiles as $research) {
    $filename = $research->filename;
    if (in_array($filename, $favoriteFilenames)) {
        $research->isInFavorites = true;
    } else {
        $research->isInFavorites = false;
    }
}
$collegeUsersAlgo = view::query()
->join('research', 'research.filename', '=', 'view.filename')
->select('view.filename', 'research.college', view::raw('COUNT(DISTINCT view.userview_id) as userCount'))
->where('research.college', 143)
->groupBy('view.filename', 'research.college') 
->orderBy('userCount', 'DESC')
->get();
return view('userColleges.user-cuyo', compact('userfiles', 'colleges','collegeUsersAlgo','requests','user', 'collegeUserName'));
}

public function dumaranIndex(){

    $collegeUserName = "Dumaran Campus Theses";
    $perPage = 12;
    $user = Auth::user();
    $requests = requests::where('status', 'pending')
    ->where('userId', $user->id);
    $userfiles = research::query()
    ->join('college', 'research.college', '=', 'college.id')
    ->select('research.*', 'college.college_name')
    ->where('research.college', '144')
    ->orderBy('filename', 'ASC');

    $userfiles = $userfiles->paginate($perPage);
    $colleges = college::all()->where('id', '144'); 

$favoriteFilenames = favorites::where('user_id', $user->id)->pluck('filename')->toArray();

foreach ($userfiles as $research) {
    $filename = $research->filename;
    if (in_array($filename, $favoriteFilenames)) {
        $research->isInFavorites = true;
    } else {
        $research->isInFavorites = false;
    }
}
$collegeUsersAlgo = view::query()
->join('research', 'research.filename', '=', 'view.filename')
->select('view.filename', 'research.college', view::raw('COUNT(DISTINCT view.userview_id) as userCount'))
->where('research.college', 144)
->groupBy('view.filename', 'research.college') 
->orderBy('userCount', 'DESC')
->get();
return view('userColleges.user-dumaran', compact('userfiles', 'colleges','collegeUsersAlgo','requests','user', 'collegeUserName'));
}
public function elnidoIndex(){

    $collegeUserName = "Elnido Campus Theses";
    $perPage = 12;
    $user = Auth::user();
    $requests = requests::where('status', 'pending')
    ->where('userId', $user->id);
    $userfiles = research::query()
    ->join('college', 'research.college', '=', 'college.id')
    ->select('research.*', 'college.college_name')
    ->where('research.college', '145')
    ->orderBy('filename', 'ASC');

    $userfiles = $userfiles->paginate($perPage);
    $colleges = college::all()->where('id', '145'); 

$favoriteFilenames = favorites::where('user_id', $user->id)->pluck('filename')->toArray();

foreach ($userfiles as $research) {
    $filename = $research->filename;
    if (in_array($filename, $favoriteFilenames)) {
        $research->isInFavorites = true;
    } else {
        $research->isInFavorites = false;
    }
}
$collegeUsersAlgo = view::query()
->join('research', 'research.filename', '=', 'view.filename')
->select('view.filename', 'research.college', view::raw('COUNT(DISTINCT view.userview_id) as userCount'))
->where('research.college', 145)
->groupBy('view.filename', 'research.college') 
->orderBy('userCount', 'DESC')
->get();
return view('userColleges.user-elnido', compact('userfiles', 'colleges','collegeUsersAlgo','requests','user', 'collegeUserName'));
}

public function linapacanIndex(){

    $collegeUserName = "Linapacan Campus Theses";
    $perPage = 12;
    $user = Auth::user();
    $requests = requests::where('status', 'pending')
    ->where('userId', $user->id);
    $userfiles = research::query()
    ->join('college', 'research.college', '=', 'college.id')
    ->select('research.*', 'college.college_name')
    ->where('research.college', '146')
    ->orderBy('filename', 'ASC');

    $userfiles = $userfiles->paginate($perPage);
    $colleges = college::all()->where('id', '146'); 

$favoriteFilenames = favorites::where('user_id', $user->id)->pluck('filename')->toArray();

foreach ($userfiles as $research) {
    $filename = $research->filename;
    if (in_array($filename, $favoriteFilenames)) {
        $research->isInFavorites = true;
    } else {
        $research->isInFavorites = false;
    }
}
$collegeUsersAlgo = view::query()
->join('research', 'research.filename', '=', 'view.filename')
->select('view.filename', 'research.college', view::raw('COUNT(DISTINCT view.userview_id) as userCount'))
->where('research.college', 146)
->groupBy('view.filename', 'research.college') 
->orderBy('userCount', 'DESC')
->get();
return view('userColleges.user-linapacan', compact('userfiles', 'colleges','collegeUsersAlgo','requests','user', 'collegeUserName'));
}

public function narraIndex(){

    $collegeUserName = "Narra Campus Theses";
    $perPage = 12;
    $user = Auth::user();
    $requests = requests::where('status', 'pending')
    ->where('userId', $user->id);
    $userfiles = research::query()
    ->join('college', 'research.college', '=', 'college.id')
    ->select('research.*', 'college.college_name')
    ->where('research.college', '147')
    ->orderBy('filename', 'ASC');

    $userfiles = $userfiles->paginate($perPage);
    $colleges = college::all()->where('id', '147'); 

$favoriteFilenames = favorites::where('user_id', $user->id)->pluck('filename')->toArray();

foreach ($userfiles as $research) {
    $filename = $research->filename;
    if (in_array($filename, $favoriteFilenames)) {
        $research->isInFavorites = true;
    } else {
        $research->isInFavorites = false;
    }
}
$collegeUsersAlgo = view::query()
->join('research', 'research.filename', '=', 'view.filename')
->select('view.filename', 'research.college', view::raw('COUNT(DISTINCT view.userview_id) as userCount'))
->where('research.college', 147)
->groupBy('view.filename', 'research.college') 
->orderBy('userCount', 'DESC')
->get();
return view('userColleges.user-narra', compact('userfiles', 'colleges','collegeUsersAlgo','requests','user', 'collegeUserName'));
}

public function quezonIndex(){

    $collegeUserName = "Quezon Campus Theses";
    $perPage = 12;
    $user = Auth::user();
    $requests = requests::where('status', 'pending')
    ->where('userId', $user->id);
    $userfiles = research::query()
    ->join('college', 'research.college', '=', 'college.id')
    ->select('research.*', 'college.college_name')
    ->where('research.college', '148')
    ->orderBy('filename', 'ASC');

    $userfiles = $userfiles->paginate($perPage);
    $colleges = college::all()->where('id', '148'); 

$favoriteFilenames = favorites::where('user_id', $user->id)->pluck('filename')->toArray();

foreach ($userfiles as $research) {
    $filename = $research->filename;
    if (in_array($filename, $favoriteFilenames)) {
        $research->isInFavorites = true;
    } else {
        $research->isInFavorites = false;
    }
}
$collegeUsersAlgo = view::query()
->join('research', 'research.filename', '=', 'view.filename')
->select('view.filename', 'research.college', view::raw('COUNT(DISTINCT view.userview_id) as userCount'))
->where('research.college', 148)
->groupBy('view.filename', 'research.college') 
->orderBy('userCount', 'DESC')
->get();
return view('userColleges.user-quezon', compact('userfiles', 'colleges','collegeUsersAlgo','requests','user', 'collegeUserName'));
}

public function rizalIndex(){

    $collegeUserName = "Rizal Campus Theses";
    $perPage = 12;
    $user = Auth::user();
    $requests = requests::where('status', 'pending')
    ->where('userId', $user->id);
    $userfiles = research::query()
    ->join('college', 'research.college', '=', 'college.id')
    ->select('research.*', 'college.college_name')
    ->where('research.college', '149')
    ->orderBy('filename', 'ASC');

    $userfiles = $userfiles->paginate($perPage);
    $colleges = college::all()->where('id', '149'); 

$favoriteFilenames = favorites::where('user_id', $user->id)->pluck('filename')->toArray();

foreach ($userfiles as $research) {
    $filename = $research->filename;
    if (in_array($filename, $favoriteFilenames)) {
        $research->isInFavorites = true;
    } else {
        $research->isInFavorites = false;
    }
}
$collegeUsersAlgo = view::query()
->join('research', 'research.filename', '=', 'view.filename')
->select('view.filename', 'research.college', view::raw('COUNT(DISTINCT view.userview_id) as userCount'))
->where('research.college', 149)
->groupBy('view.filename', 'research.college') 
->orderBy('userCount', 'DESC')
->get();
return view('userColleges.user-rizal', compact('userfiles', 'colleges','collegeUsersAlgo','requests','user', 'collegeUserName'));
}

public function roxasIndex(){

    $collegeUserName = "Roxas Campus Theses";
    $perPage = 12;
    $user = Auth::user();
    $requests = requests::where('status', 'pending')
    ->where('userId', $user->id);
    $userfiles = research::query()
    ->join('college', 'research.college', '=', 'college.id')
    ->select('research.*', 'college.college_name')
    ->where('research.college', '150')
    ->orderBy('filename', 'ASC');

    $userfiles = $userfiles->paginate($perPage);
    $colleges = college::all()->where('id', '150'); 

$favoriteFilenames = favorites::where('user_id', $user->id)->pluck('filename')->toArray();

foreach ($userfiles as $research) {
    $filename = $research->filename;
    if (in_array($filename, $favoriteFilenames)) {
        $research->isInFavorites = true;
    } else {
        $research->isInFavorites = false;
    }
}
$collegeUsersAlgo = view::query()
->join('research', 'research.filename', '=', 'view.filename')
->select('view.filename', 'research.college', view::raw('COUNT(DISTINCT view.userview_id) as userCount'))
->where('research.college', 150)
->groupBy('view.filename', 'research.college') 
->orderBy('userCount', 'DESC')
->get();
return view('userColleges.user-roxas', compact('userfiles', 'colleges','collegeUsersAlgo','requests','user', 'collegeUserName'));
}

public function sanrafaelIndex(){

    $collegeUserName = "San Rafael Campus Theses";
    $perPage = 12;
    $user = Auth::user();
    $requests = requests::where('status', 'pending')
    ->where('userId', $user->id);
    $userfiles = research::query()
    ->join('college', 'research.college', '=', 'college.id')
    ->select('research.*', 'college.college_name')
    ->where('research.college', '151')
    ->orderBy('filename', 'ASC');

    $userfiles = $userfiles->paginate($perPage);
    $colleges = college::all()->where('id', '151'); 

$favoriteFilenames = favorites::where('user_id', $user->id)->pluck('filename')->toArray();

foreach ($userfiles as $research) {
    $filename = $research->filename;
    if (in_array($filename, $favoriteFilenames)) {
        $research->isInFavorites = true;
    } else {
        $research->isInFavorites = false;
    }
}
$collegeUsersAlgo = view::query()
->join('research', 'research.filename', '=', 'view.filename')
->select('view.filename', 'research.college', view::raw('COUNT(DISTINCT view.userview_id) as userCount'))
->where('research.college', 151)
->groupBy('view.filename', 'research.college') 
->orderBy('userCount', 'DESC')
->get();
return view('userColleges.user-sanrafael', compact('userfiles', 'colleges','collegeUsersAlgo','requests','user', 'collegeUserName'));
}

public function sanvicenteIndex(){

    $collegeUserName = "San Vicente Campus Theses";
    $perPage = 12;
    $user = Auth::user();
    $requests = requests::where('status', 'pending')
    ->where('userId', $user->id);
    $userfiles = research::query()
    ->join('college', 'research.college', '=', 'college.id')
    ->select('research.*', 'college.college_name')
    ->where('research.college', '152')
    ->orderBy('filename', 'ASC');

    $userfiles = $userfiles->paginate($perPage);
    $colleges = college::all()->where('id', '152'); 

$favoriteFilenames = favorites::where('user_id', $user->id)->pluck('filename')->toArray();

foreach ($userfiles as $research) {
    $filename = $research->filename;
    if (in_array($filename, $favoriteFilenames)) {
        $research->isInFavorites = true;
    } else {
        $research->isInFavorites = false;
    }
}
$collegeUsersAlgo = view::query()
->join('research', 'research.filename', '=', 'view.filename')
->select('view.filename', 'research.college', view::raw('COUNT(DISTINCT view.userview_id) as userCount'))
->where('research.college', 152)
->groupBy('view.filename', 'research.college') 
->orderBy('userCount', 'DESC')
->get();
return view('userColleges.user-sanvicente', compact('userfiles', 'colleges','collegeUsersAlgo','requests','user', 'collegeUserName'));
}

public function sofronioIndex(){

    $collegeUserName = "Sofronio Española Campus Theses";
    $perPage = 12;
    $user = Auth::user();
    $requests = requests::where('status', 'pending')
    ->where('userId', $user->id);
    $userfiles = research::query()
    ->join('college', 'research.college', '=', 'college.id')
    ->select('research.*', 'college.college_name')
    ->where('research.college', '153')
    ->orderBy('filename', 'ASC');

    $userfiles = $userfiles->paginate($perPage);
    $colleges = college::all()->where('id', '153'); 

$favoriteFilenames = favorites::where('user_id', $user->id)->pluck('filename')->toArray();

foreach ($userfiles as $research) {
    $filename = $research->filename;
    if (in_array($filename, $favoriteFilenames)) {
        $research->isInFavorites = true;
    } else {
        $research->isInFavorites = false;
    }
}
$collegeUsersAlgo = view::query()
->join('research', 'research.filename', '=', 'view.filename')
->select('view.filename', 'research.college', view::raw('COUNT(DISTINCT view.userview_id) as userCount'))
->where('research.college', 153)
->groupBy('view.filename', 'research.college') 
->orderBy('userCount', 'DESC')
->get();
return view('userColleges.user-sofronio', compact('userfiles', 'colleges','collegeUsersAlgo','requests','user', 'collegeUserName'));
}

public function taytayIndex(){

    $collegeUserName = "Taytay Campus Theses";
    $perPage = 12;
    $user = Auth::user();
    $requests = requests::where('status', 'pending')
    ->where('userId', $user->id);
    $userfiles = research::query()
    ->join('college', 'research.college', '=', 'college.id')
    ->select('research.*', 'college.college_name')
    ->where('research.college', '154')
    ->orderBy('filename', 'ASC');

    $userfiles = $userfiles->paginate($perPage);
    $colleges = college::all()->where('id', '154'); 

$favoriteFilenames = favorites::where('user_id', $user->id)->pluck('filename')->toArray();

foreach ($userfiles as $research) {
    $filename = $research->filename;
    if (in_array($filename, $favoriteFilenames)) {
        $research->isInFavorites = true;
    } else {
        $research->isInFavorites = false;
    }
}
$collegeUsersAlgo = view::query()
->join('research', 'research.filename', '=', 'view.filename')
->select('view.filename', 'research.college', view::raw('COUNT(DISTINCT view.userview_id) as userCount'))
->where('research.college', 154)
->groupBy('view.filename', 'research.college') 
->orderBy('userCount', 'DESC')
->get();
return view('userColleges.user-taytay', compact('userfiles', 'colleges','collegeUsersAlgo','requests','user', 'collegeUserName'));
}
    
}
