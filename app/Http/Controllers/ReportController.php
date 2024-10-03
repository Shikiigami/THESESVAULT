<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Models\recentLogin;


class ReportController extends Controller
{
    public function generate()
    {
        $myquery = "SELECT college.college_name as 'myCollege Name', COUNT(DISTINCT research.id) as 'myTotal Count'
        FROM research
        INNER JOIN college ON college.id = research.college
        GROUP BY college.college_name, research.college
        ORDER BY `myTotal Count` DESC";

        $myresults = DB::select($myquery);

        // Create a PDF view
        $pdf = Pdf::loadView('pdf.report', compact('myresults'));

        // Set the response headers for downloading the PDF file
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="report.pdf"',
        ];

        // Return the PDF response
        return $pdf->stream('report.pdf');
    }
   public function generatePiePDF()
{
    $piequery = "SELECT research.program as 'Program', COUNT(DISTINCT research.id) as 'TotalResearch_Count' FROM research
             GROUP BY research.program ORDER BY 'TotalResearch_Count' DESC";

    $pieResults = DB::select($piequery);
    $count_research = [];
    $label_program = [];

    if (count($pieResults) > 0) {
        foreach ($pieResults as $pierow) {
            $count_research[] = $pierow->{'TotalResearch_Count'};
            $label_program[] = $pierow->{'Program'};
        }
    } else {
        return "No records matching your query were found.";
    }

    $pdf = Pdf::loadView('pdf.pie_report', compact('count_research', 'label_program'));

    $headers = [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'attachment; filename="pie_report.pdf"',
    ];

    return $pdf->stream('pie_report.pdf', $headers);
}

    public function generateCollegeReportDate(Request $request){

    $start_date = Carbon::parse($request->input('start_date'));
    $end_date = Carbon::parse($request->input('end_date'));

    $myquery = "SELECT college.college_name as 'myCollege Name', COUNT(DISTINCT research.id) as 'myTotal Count'
        FROM research
        INNER JOIN college ON college.id = research.college
        WHERE research.date_published BETWEEN :start_date AND :end_date
        GROUP BY college.college_name, research.college
        ORDER BY `myTotal Count` DESC";

    $myresults = DB::select($myquery, ['start_date' => $start_date, 'end_date' => $end_date]);

    // Create a PDF view
    $pdf = Pdf::loadView('pdf.report-collegeDate', compact('myresults','start_date','end_date'));

    // Set the response headers for downloading the PDF file
    $headers = [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'attachment; filename="report-collegeDate.pdf"',
    ];

    // Return the PDF response
    return $pdf->stream('report-collegeDate.pdf');
    }

    public function generateProgramReportDate(Request $request){
        
        $start_date = Carbon::parse($request->input('start_date'));
        $end_date = Carbon::parse($request->input('end_date'));
    
        $piequery = "SELECT research.program as 'Program', COUNT(DISTINCT research.id) as 'TotalResearch_Count'
                     FROM research
                     WHERE research.date_published BETWEEN :start_date AND :end_date
                     GROUP BY research.program
                     ORDER BY 'TotalResearch_Count' DESC";
    
        $pieResults = DB::select($piequery, ['start_date' => $start_date, 'end_date' => $end_date]);
        $count_research = [];
        $label_program = [];
    
        if (count($pieResults) > 0) {
            foreach ($pieResults as $pierow) {
                $count_research[] = $pierow->{'TotalResearch_Count'};
                $label_program[] = $pierow->{'Program'};
            }
        } else {
            return "No records matching your query were found.";
        }
    
        $pdf = Pdf::loadView('pdf.report-programDate', compact('count_research', 'label_program', 'start_date', 'end_date'));
    
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="program-reportDate.pdf"',
        ];
    
        return $pdf->stream('program-reportDate.pdf');
    }
    
    
      public function generateLoginPDF(Request $request)
{
    $year = $request->input('year');
    $month = $request->input('month');

    $logins = recentLogin::select('users.program', DB::raw('COUNT(*) as login_count'))
        ->join('users', 'recent_login.idUser', '=', 'users.id')
        ->whereYear('login_time', $year)
        ->whereMonth('login_time', $month)
        ->where('users.role', '=', 'user')
        ->groupBy('users.program')
        ->orderByDesc('login_count')
        ->get();

    $pdf = Pdf::loadView('pdf.loginProgram-report', compact('logins', 'year', 'month'));
    return $pdf->stream('login_reportByMonth.pdf');
}

public function generateLoginYearPDF(Request $request)
{
    $year = $request->input('year');

    $logins = recentLogin::select('users.program', DB::raw('COUNT(*) as login_count'))
        ->join('users', 'recent_login.idUser', '=', 'users.id')
        ->whereYear('login_time', $year)
        ->where('users.role', '=', 'user')
        ->groupBy('users.program')
        ->orderByDesc('login_count')
        ->get();

    $pdf = Pdf::loadView('pdf.loginProgramYear-report', compact('logins', 'year'));
    return $pdf->stream('login_reportByYear.pdf');
}

public function generateLoginDayPDF(Request $request)
{
    $day = $request->input('day');
    $currentMonth = date('m');
    $currentYear = date('Y');

    $logins = RecentLogin::select('users.program', DB::raw('COUNT(*) as login_count'))
        ->join('users', 'recent_login.idUser', '=', 'users.id')
        ->whereDay('login_time', $day)
        ->whereMonth('login_time', $currentMonth)
        ->whereYear('login_time', $currentYear)
        ->where('users.role', 'user')
        ->groupBy('users.program')
        ->orderByDesc('login_count')
        ->get();

    $pdf = Pdf::loadView('pdf.loginProgramDay-report', compact('logins', 'day', 'currentMonth', 'currentYear'));
    return $pdf->stream('login_reportByDay.pdf');
}
    
    
}



