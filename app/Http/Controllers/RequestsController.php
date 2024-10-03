<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\research;
use App\Models\requests;
use App\Models\fullTextRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notifications\FullTextRequestNotification;
use App\Notifications\RequestDeclinedNotification;
use App\Notifications\RequestApprovedNotification;
use Illuminate\Support\Facades\Notification;

class RequestsController extends Controller
{
    public function index(){
        $user = Auth::user();
        $requests = requests::orderBy('created_at', 'desc')->get();
        return view('layouts.requests', compact('requests'));
    }

    public function request( Request $request, string $id){

        $user = Auth::user();
        $research = research::find($id);
        $researchId = $research->id;
        if (!$research) {
            return redirect()->back()->with('error', 'Research item not found.');
        }

        $researchId = $research->id; 
        $existingFile = Requests::where('researchId', $researchId)
        ->where('userId', $user->id)
        ->first();

        if ($existingFile) {
            return redirect()->back()->with('error', 'You have still pending request for this thesis');
        }  
        
        $newRequest = new requests();
        $newRequest->userId = $user->id;
        $newRequest->researchId = $researchId;
        $newRequest->purpose = $request->input('purpose');
        $newRequest->receive_thru= $request->input('receive_thru');
        $newRequest->save(); 
    
        return redirect()->back()->with('success', 'Requests sent sucessfully.');
    }

    public function requestsIndex(){
        $userId =  Auth::user()->id; // Assuming you want to get the user's ID
        $userRequests = DB::table('requests')
        ->join('research', 'requests.researchId', '=', 'research.id')
        ->join('users', 'requests.userId', '=', 'users.id')
        ->where('userId', $userId)
        ->select('requests.*','requests.id as requestId','users.*', 'research.*')
        ->paginate(6);
        return view('layouts.user-requests', compact('userRequests', 'userId'));
    }

    public function approvedStatus( Request $request, string $id){

        $req_status = 'Approved';
        $editRequest = requests::findOrFail($id); 
        $editRequest->req_status = $req_status; 
        $editRequest->save();

        $editRequest->user->notify(new RequestApprovedNotification($editRequest));

        return redirect()->back()->with('success', 'status approved sucessfully.');
    }

    public function declinedStatus(Request $request, string $id) {
        $req_status = 'Declined';
        $editRequest = requests::findOrFail($id); 
        $editRequest->req_status = $req_status; 
        $editRequest->save();
    
        // Send notification to the user, passing the $editRequest object
        $editRequest->user->notify(new RequestDeclinedNotification($editRequest));
    
        return redirect()->back()->with('success', 'Status declined successfully.');
    }
    
    public function undo( Request $request, string $id){

        $req_status = 'Pending';
        $editRequest = requests::findOrFail($id); 
        $editRequest->req_status = $req_status; 
        $editRequest->save();
        return redirect()->back()->with('success', 'status undo sucessfully.');
    }

    public function destroy(Request $request, string $id){
        {
            $myrequest = requests::findOrFail($id);
            $myrequest->delete();
            return redirect()->back()->with('success', 'request removed successfully.');
        }
    }

    public function totalIndex(){
        $requests = requests::select(DB::raw('DATE(created_at) as date, DAY(created_at) as day, MONTH(created_at) as month, COUNT(DISTINCT id) as total'))
                            ->groupBy(DB::raw('DATE(created_at)'), DB::raw('DAY(created_at)'), DB::raw('MONTH(created_at)'))
                            ->orderBy('created_at', 'desc')
                            ->where('req_status', 'Approved')
                            ->get(); 
        return view('layouts.total-requests', compact('requests'));
    }
    Public function fullTextRequestsIndex(){
        $user = Auth::user();
        $fullRequests = fullTextRequests::orderBy('created_at', 'desc')->get();
        return view('layouts.full-text-requests', compact('fullRequests'));
}

public function fullApprovedStatus(Request $request, string $id)
{
    $fullReq_status = 'Approved';
    $editFullRequest = fullTextRequests::findOrFail($id); 
    $editFullRequest->requests_stat = $fullReq_status;
    $editFullRequest->save();


    $editFullRequest->full_userId->notify(new FullTextRequestNotification($editFullRequest));

    return redirect()->back()->with('success', 'Full Text request approved successfully.');
}

public function fullDeclinedStatus(Request $request, string $id) {
    $fullReq_status = 'Declined';
    $editFullRequest = fullTextRequests::findOrFail($id); 
    $editFullRequest->requests_stat = $fullReq_status; 
    $editFullRequest->save();

    return redirect()->back()->with('success', 'Full Text Request has been declined');
}

public function addFullRequest( Request $request, string $id){

    $user = Auth::user();
    $research = research::find($id);
    $researchId = $research->id;
    if (!$research) {
        return redirect()->back()->with('error', 'Research item not found.');
    }

    $researchId = $research->id; 
    
    $newRequest = new fullTextRequests();
    $newRequest->userId = $user->id;
    $newRequest->researchId = $researchId;
    $newRequest->purpose = $request->input('purpose');
    $newRequest->save(); 

    return redirect()->back()->with('success', 'Requests sent sucessfully.');
}
    
}
