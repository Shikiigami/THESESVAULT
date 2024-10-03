<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\messages;

class LandingPageController extends Controller
{
    public function index(){
        return view('layouts.newlandingPage');
    }

    public function store(Request $request)

    {
    $message = new messages();
    $message->fullName = $request->input('fullName');
    $message->email = $request->input('email');
    $message->content = $request->input('content');
    
            if ($request->has('submit')) {
                $message->save();
                return redirect()->back()->with('success', 'Message sent Successfully!');
            }      
        else {
            return redirect()->back()->with('error', 'Message not sent');
        }
    }  
}
