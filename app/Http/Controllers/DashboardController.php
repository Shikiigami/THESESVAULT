<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\research;
use App\Models\User;
use Carbon\Carbon;
use PHPUnit\Framework\Constraint\Count;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $files = research::orderBy('created_at', 'DESC')->limit(6)->get();

        $currentDateTime = Carbon::now();

        foreach ($files as $file) {
            $fileDateTime = Carbon::parse($file->created_at);
            $timeDifference = $currentDateTime->diff($fileDateTime);
            $file->formattedTimeDifference = $this->formatTimeDifference($timeDifference);
        }

        $userCount = User::count();
        $filesCount = research::count();
        $user = auth()->user();
        $userCollegeId = $user->college_id; // Get the authenticated user's college ID

$query = "SELECT
    filename AS `File Name`,
    COUNT(DISTINCT userview_id) AS `User Count`
    FROM
    `VIEW` 
    WHERE
    :user_college_id = research_college
    GROUP BY
    filename
    ORDER BY
    `User Count` DESC
    LIMIT 7";

$results = DB::select($query, ['user_college_id' => $userCollegeId]);

$count_user = [];
$label_chart = [];


foreach ($results as $row) {
    $count_user[] = $row->{'User Count'};
    $label_chart[] = str_replace('.pdf', '', $row->{'File Name'});


}

$myquery = "SELECT college.college_name as 'myCollege Name', COUNT(DISTINCT research.id) as 'myTotal Count'
FROM research
INNER JOIN college ON college.id = research.college
GROUP BY college.college_name, research.college
ORDER BY `myTotal Count` DESC";
        
$myresults = DB::select($myquery);

$count_mycollege = [];
$lab_mychart = [];

if (count($myresults) > 0) {
    foreach ($myresults as $myrow) {
        $count_mycollege[] = $myrow->{'myTotal Count'};
        $lab_mychart[] = $myrow->{'myCollege Name'};
    }
} else {
    echo "No records matching your query were found.";
}

$count_mycollege = $count_mycollege ?? [];
$lab_mychart = $lab_mychart ?? [];

$piequery = "SELECT research.program as 'Program', COUNT(DISTINCT research.id) as 'TotalResearch_Count' FROM research
             GROUP BY research.program ORDER BY 'TotalResearch_Count' DESC";

$pieResults = DB::select($piequery);
$count_research = [];
$label_program =[];

if (count($pieResults) > 0) {
    foreach ($pieResults as $pierow) {
        $count_research[] = $pierow->{'TotalResearch_Count'};
        $label_program[] = $pierow->{'Program'};
    }
} else {
    echo "No records matching your query were found.";
}

$user = Auth::user();
$fieldName = '';

if ($user->interest === 'Business') {
    $fieldName = 'Business';
} elseif ($user->interest === 'Technology') {
    $fieldName = 'Technology';
} elseif ($user->interest === 'Education') {
    $fieldName = 'Education';
}
else{
    $fieldName = '';
}

$researchData = research::where('fieldname', $fieldName)
                        ->select('filename','callno')
                        ->get();

$interestQuery = "SELECT interest FROM users WHERE interest IS NOT NULL GROUP BY interest ORDER BY COUNT(DISTINCT users.id) DESC LIMIT 1";
$percentageQuery = "SELECT
(COUNT(*) / (SELECT COUNT(*) FROM users)) * 100 AS highest_percentage
FROM users
WHERE interest = (
SELECT interest
FROM users Where Interest is not null
GROUP BY interest
ORDER BY COUNT(*) DESC
LIMIT 1
)
";
$interestResult = DB::select($interestQuery);
$percentageResult = DB::select($percentageQuery);

$interest = $interestResult[0]->interest ?? null;
$percentage = $percentageResult[0]->percentage ?? 0;

function calculateSupport($researchItem){

    return DB::table('view')
        ->where('filename', $researchItem->filename)
        ->take(5)
        ->count();
}
    $minSupportThreshold = 5;
    $researchItems = research::with('views')->select('id', 'filename')->get();
    $supportData = [];
    
    foreach ($researchItems as $researchItem) {
        $support = calculateSupport($researchItem); // Implement this function
        if ($support >= $minSupportThreshold) {
            $supportData[$researchItem->id] = $support;
        }
    }
    // Sort the support data by support value (descending)
    arsort($supportData);
    $mostViewedResearchItems = array_keys($supportData);
    $topFrequentItemsets = array_slice($mostViewedResearchItems, 0, 5);
    
    // Retrieve the filenames of the top frequent itemsets from the database
    $filenames = research::whereIn('id', $topFrequentItemsets)->pluck('filename');
    $distinctYears = Research::selectRaw('YEAR(date_published) as research_year')
    ->distinct()
    ->orderByDesc('research_year')
    ->pluck('research_year');

    return view('layouts.index', compact('files', 'userCount', 'filesCount', 'count_user', 'label_chart', 'count_mycollege', 'lab_mychart', 'count_research','label_program','interest','percentage',) + 
    ['researchData' => $researchData] + ['percentageResult' => $percentageResult] + ['topFrequentItemsets'=>$filenames] + ['distinctYears' => $distinctYears]);

    }      
    private function formatTimeDifference($timeDifference)
    {
        if ($timeDifference->y > 0) {
            return $timeDifference->y . ' year' . ($timeDifference->y > 1 ? 's' : '');
        } elseif ($timeDifference->m > 0) {
            return $timeDifference->m . ' month' . ($timeDifference->m > 1 ? 's' : '');
        } elseif ($timeDifference->d > 0) {
            return $timeDifference->d . ' day' . ($timeDifference->d > 1 ? 's' : '');
        } elseif ($timeDifference->h > 0) {
            return $timeDifference->h . ' hour' . ($timeDifference->h > 1 ? 's' : '');
        } else {
            return $timeDifference->i . ' min' . ($timeDifference->i > 1 ? 's' : '');
        }
}

public function loadData(Request $request, $year)
{
    $mquery = DB::table('research')
        ->select(DB::raw('MONTH(research.date_published) as Months'), DB::raw('COUNT(DISTINCT id) as TotalResearch'))
        ->whereYear('research.date_published', $year)
        ->groupBy(DB::raw('MONTH(research.date_published)'))
        ->orderBy(DB::raw('MONTH(research.date_published)'))
        ->get();

    $count_myresearch = [];
    $month_chart = [];

    if ($mquery->count() > 0) {
        foreach ($mquery as $rowm) {
            $count_myresearch[] = $rowm->TotalResearch;
            $month_chart[] = $rowm->Months;
        }
    }
    logger()->info('Fetched data:', ['year' => $year, 'month_chart' => $month_chart, 'count_myresearch' => $count_myresearch]);

    if ($request->ajax()) {
        return response()->json(['month_chart' => $month_chart, 'count_research' => $count_myresearch]);
    } else {
        $month_chart = array_map(function ($numericMonth) {
            return date("F", mktime(0, 0, 0, $numericMonth, 1));
        }, $month_chart);

        logger()->info('Converted data:', ['year' => $year, 'month_chart' => $month_chart, 'count_myresearch' => $count_myresearch]);

        return view('layouts.index', ['month_chart' => $month_chart, 'count_research' => $count_myresearch]);
    }
}


}