<?php
namespace App\Http\Controllers;

use App\Models\Adviser;
use App\Models\research;
use App\Models\college;


use Illuminate\Http\Request;

class CsController extends Controller
{
    public function index(){

        $perPage = 3;
        $csfiles = research::query()
        ->join('college', 'research.college', '=', 'college.id')
        ->join('adviser', 'research.adviser', '=', 'adviser.adviser_name')
        ->select('research.*', 'college.college_name','adviser.adviser_name')
        ->where('college', '131')
        ->orderBy('filename', 'ASC');

    $csfiles = $csfiles->paginate($perPage);
    $colleges = college::all()->where('id', '131');
    $advisers = Adviser::all();
    return view('layouts.cs-research', compact('csfiles', 'colleges','advisers'));
    }
}
