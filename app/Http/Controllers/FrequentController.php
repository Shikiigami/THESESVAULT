<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\research;

class FrequentController extends Controller
{


public function showTopFrequentItemsets()
{
    

    function calculateSupport($researchItem){

    return DB::table('view')
        ->where('filename', $researchItem->filename)
        ->take(5)
        ->count();
}
    $minSupportThreshold = 5;
    $researchItems = research::all();
    $supportData = [];

    foreach ($researchItems as $researchItem) {
        $support = calculateSupport($researchItem); // Implement this function
        if ($support >= $minSupportThreshold) {
            $supportData[$researchItem->id] = $support;
        }
    }

    // Sort the support data by support value (descending)
    arsort($supportData);

    // Get the most-viewed research items as frequent itemsets
    $mostViewedResearchItems = array_keys($supportData);

    // Limit to the top 5 frequent itemsets
    $topFrequentItemsets = array_slice($mostViewedResearchItems, 0, 5);

    // Retrieve the filenames of the top frequent itemsets from the database
    $filenames = research::whereIn('id', $topFrequentItemsets)->pluck('filename');

    // Pass the top 5 frequent itemsets (filenames) to the Blade view
    return view('layouts.index')->with('topFrequentItemsets', $filenames);

}

}
