<?php
namespace App\Http\Controllers;

use App\Models\Adviser;
use App\Models\research;
use App\Models\college;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class CsController extends Controller
{
    public function index(){

    $csfiles = research::where('college', '=', 131)->orderBy('filename', 'ASC')->get();
    $colleges = college::all()->where('id', '131');
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
    return view('layouts.cs-research', compact('csfiles', 'colleges','advisers','enumValues'));
    }
}
