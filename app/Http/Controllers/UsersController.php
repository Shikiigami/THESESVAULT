<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\recentLogin;
use App\Models\College;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;



class UsersController extends Controller
{
   public function index(){
       $campusCollege = ['Araceli','Balabac','Bataraza','Brooke\'s Point','Coron','PCAT Cuyo','Dumaran','El Nido','Linapacan','Narra',
      'Quezon','Rizal','Roxas','San Rafael','San Vicente','Sofronio Española','Taytay'];
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
  
  
    return view('layouts.users-profile', compact('enumValues','campusCollege'));
   }
   
    public function recentLogin(Request $request)
{
    $month = "";
    $year ="";
    $userToday = recentLogin::join('users', 'recent_login.idUser', '=', 'users.id')
    ->whereDate('login_time', '=', now()->format('Y-m-d'))
    ->where('users.role', '=', 'user')
    ->count();
    $years = recentLogin::distinct()
        ->pluck(DB::raw('YEAR(login_time) as year'))
        ->toArray();
        
    $recentUsers = recentLogin::join('users', 'recent_login.idUser', '=', 'users.id')
        ->where('users.role', '=', 'user')
        ->orderBy('recent_login.login_time', 'DESC')
        ->get();

    $loginCountsYear = $this->getLoginCountByYear();

    return view('log.recent-login', compact('recentUsers', 'loginCountsYear', 'years','month','year','userToday'));
}

public function getLoginCountByYear()
{
    $loginCountsYear = recentLogin::join('users', 'recent_login.idUser', '=', 'users.id')
        ->select(DB::raw('YEAR(login_time) as year'), DB::raw('COUNT(*) as count'))
        ->where('users.role', '=', 'user')
        ->groupBy(DB::raw('YEAR(login_time)'))
        ->get();

    return $loginCountsYear;
}


public function selectYear(Request $request)
{
    $selectedYearCount = recentLogin::join('users', 'recent_login.idUser', '=', 'users.id')
        ->select(DB::raw('YEAR(login_time) as year'), DB::raw('COUNT(*) as count'))
        ->where('users.role', '=', 'user')
        ->where(DB::raw('YEAR(login_time)'), $request->year)
        ->groupBy(DB::raw('YEAR(login_time)')) 
        ->first();


    return response()->json([
        'selectedYearCount' => $selectedYearCount->count,
    ]);
}


    public function loginByMonth(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'year' => 'required|numeric',
            'month' => 'required|numeric|min:1|max:12', 
        ]);
        $year = $validatedData['year'];
        $month = $validatedData['month'];
        $userToday = recentLogin::join('users', 'recent_login.idUser', '=', 'users.id')
        ->whereDate('login_time', '=', now()->format('Y-m-d'))
        ->where('users.role', '=', 'user')
        ->count();

        
        // Calculate login count only if form is submitted
        $loginCount = null;
        if ($request->has('submit')) {
            $loginCount = recentLogin::join('users', 'recent_login.idUser', '=', 'users.id')
                                      ->whereYear('login_time', $year)
                                      ->whereMonth('login_time', $month)
                                      ->where('users.role', '=', 'user')
                                      ->count();
        }
    
        // Pass the login count to the view
        return view('log.recent-login', [
            
            'years' =>  $years = recentLogin::distinct()
            ->pluck(DB::raw('YEAR(login_time) as year'))
            ->toArray(),

            'loginCountsYear' =>  $loginCountsYear = $this->getLoginCountByYear(),

            'recentUsers' => recentLogin::join('users', 'recent_login.idUser', '=', 'users.id')
                                         ->where('users.role', '=', 'user')
                                         ->get(),
            'loginCounts' => $loginCount,
            'year' => $year,
            'month' => $month,
            'userToday' => $userToday,
        ]);
    }

    public function programIndex(){

        

        $distinctYears = recentLogin::selectRaw('YEAR(login_time) as loginTime_Year')
        ->distinct()
        ->orderByDesc('loginTime_Year')
        ->pluck('loginTime_Year');

        return view('log.program-stat',['distinctYears' => $distinctYears]);
    }

public function loginsByYearAndMonth(Request $request)
    {
        // Retrieve distinct years and months from recent_login table
        $years = recentLogin::select(DB::raw('YEAR(login_time) as year'))
                            ->distinct()
                            ->orderBy('year', 'desc')
                            ->pluck('year');

        $months = recentLogin::select(DB::raw('MONTH(login_time) as month'))
                             ->distinct()
                             ->orderBy('month', 'asc')
                             ->pluck('month');

        // Pass the years and months data to your view
        return view('login.index', compact('years', 'months'));
    }

}