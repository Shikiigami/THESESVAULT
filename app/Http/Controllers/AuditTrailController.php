<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\history;
use App\Models\User;
use App\Models\view;
use App\Models\auditLog;
use App\Models\AuditTrail;
use App\Models\download;

class AuditTrailController extends Controller
{
    public function index(){
        $paginate = history::count();
        $searches = history::select('hid', 'created_at', 'search_name', 'user_id')
            ->orderBy('created_at', 'DESC')
            ->paginate($paginate);

        $paginateView = view::count();
        $views = view::select('vid', 'research_id', 'filename','userview_id', 'viewed_at')
        ->orderBy('viewed_at', 'DESC')
        ->paginate($paginateView);

        $paginateAuditTrail = AuditTrail::count();
        $auditrails =AuditTrail::select('id', 'user_id', 'action', 'changes', 'created_at')
        ->orderBy('created_at', 'DESC')
        ->paginate($paginateAuditTrail);

        // $paginateDownload = download::count();
        // $downloads = download::select('did','user_did','dl_filename', 'created_at')
        // ->orderBy('created_at', 'DESC')
        // ->paginate($paginateDownload);

        $logs = auditLog::select('adminId', 'admin_action','research','action_date')
        ->orderBy('created_at', 'DESC')
        ->paginate(10); 

        return view('layouts.audit-trail', compact('searches','views','auditrails','logs'));
    }
}
