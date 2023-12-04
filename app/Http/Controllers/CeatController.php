<?php

namespace App\Http\Controllers;

use App\Models\Adviser;
use Illuminate\Support\Facades\Storage;
use App\Models\research;
use App\Models\college;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class CeatController extends Controller
{
    public function index(){

        $perPage = 3;
        $ceatfiles = research::query()
        ->join('college', 'research.college', '=', 'college.id')
        ->join('adviser', 'research.adviser', '=', 'adviser.adviser_name')
        ->select('research.*', 'college.college_name', 'adviser.adviser_name')
        ->where('college', '130')
        ->orderBy('filename', 'ASC');

    $ceatfiles = $ceatfiles->paginate($perPage);
    $colleges = college::all()->where('id', '130');
    $advisers = Adviser::all();
    return view('layouts.ceat-research', compact('ceatfiles', 'colleges','advisers'));
    }
 
}
