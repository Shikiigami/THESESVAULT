<?php

namespace App\Http\Controllers;

use App\Models\Adviser;
use Illuminate\Support\Facades\Storage;
use App\Models\research;
use App\Models\college;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class CeatController extends Controller
{
    public function index(){

        $perPage = 10;
        $ceatfiles = research::query()
        ->join('college', 'research.college', '=', 'college.id')
        ->join('adviser', 'research.adviser', '=', 'adviser.adviser_name')
        ->select('research.*', 'college.college_name', 'adviser.adviser_name')
        ->where('college', '130')
        ->orderBy('filename', 'ASC');

    $ceatfiles = $ceatfiles->paginate($perPage);
    $colleges = college::all()->where('id', '130');
    $advisers = Adviser::all();
    
    
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
    return view('layouts.ceat-research', compact('ceatfiles', 'colleges','advisers','enumValues'));
    }
 
}
