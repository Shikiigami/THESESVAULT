<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;


class AdminsController extends Controller
{
    public function index(){
        $campusCollege = ['Araceli','Balabac','Bataraza','Brooke\'s Point','Coron','PCAT Cuyo','Dumaran','El Nido','Linapacan','Narra',
        'Quezon','Rizal','Roxas','San Rafael','San Vicente','Sofronio Española','Taytay'];
        return view('layouts.admin-profile', compact('campusCollege'));
       }

    public function storeField(Request $request){
       
        $request->validate([
            'new_field' => 'required|unique:research,fieldname'
        ]);
    
        $existingValues = DB::select("SHOW COLUMNS FROM research WHERE Field = 'fieldname'")[0]->Type;
    
        preg_match("/^enum\((.*)\)$/", $existingValues, $matches);
        $enums = explode(',', $matches[1]);
        $enums = array_map(function($enum) {
            return trim($enum, "'");
        }, $enums);

        $newFieldValue = $request->input('new_field');
        $enums[] = $newFieldValue;
        $newEnumDefinition = "ENUM('" . implode("','", $enums) . "')";
        DB::statement("ALTER TABLE research MODIFY COLUMN fieldname $newEnumDefinition");
        DB::statement("ALTER TABLE users MODIFY COLUMN interest $newEnumDefinition");
        return redirect()->back()->with('success', 'New field value added successfully.');

    }
}