<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adviser;
use App\Models\Research;
use Illuminate\Support\Facades\DB;
use App\Models\college;

class UserAdviserController extends Controller
{
public function index()
{
        $advisers = Adviser::withCount('adviser')->orderBy('adviser_name', 'asc')->paginate(9);
        $colleges = college::all(); 
        return view('layouts.user-adviser', compact('advisers','colleges'));
}

}
