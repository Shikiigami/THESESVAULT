<?php

namespace App\Http\Controllers;

use App\Models\Adviser;
use App\Models\research;
use App\Models\College;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class AdviserController extends Controller
{
    public function index() {
        $advisers = Adviser::withCount('adviser')->orderBy('adviser_name', 'asc')->paginate();
        $colleges = college::all(); 
        return view('layouts.adviser', compact('advisers','colleges'));
    }

    public function store(Request $request)
{
    // Validate the request
    $validator = Validator::make($request->all(), [
        'adviser_name' => 'required|string',
        'adviser_college' => 'required|integer',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Invalid file. Please upload an image (JPEG, PNG, JPG, GIF) with a maximum size of 5MB.');
    }

    $adviser_nameValue = $request->input('adviser_name');
    $existingName = Adviser::where('adviser_name', $adviser_nameValue)->first();
    if ($existingName) {
        return redirect()->back()->with('error', 'Adviser already exist!');
    }
    
    if ($request->hasFile('profile_picture') && $request->file('profile_picture')->isValid()) {
        $profilePicture = $request->file('profile_picture');
        $imageName = time() . '.' . $profilePicture->getClientOriginalExtension();
        $image = Image::make($profilePicture->getRealPath())->fit(114, 120);
        $image->save(public_path('storage/advisers_pic/' . $imageName));
        $profilePicturePath =  $imageName;
    
        // Create a new Adviser instance and set the profile picture path
        $adviser = new Adviser();
        $adviser->adviser_name = $request->input('adviser_name');
        $adviser->adviser_college = $request->input('adviser_college');
        $adviser->profile_picture = $profilePicturePath;
        $adviser->save();

        return redirect()->back()->with('success', 'Adviser Added Successfully!');
    } else {
        $adviser = new Adviser();
        $adviser->adviser_name = $request->input('adviser_name');
        $adviser->adviser_college = $request->input('adviser_college');
        $adviser->save();

        return redirect()->back()->with('success', 'Adviser Added Successfully (without profile picture)!');
    }
}
    public function edit(string $id)
    {
        $file = research::findOrFail($id); 
        $colleges = college::all(); 
        $advisers = Adviser::all(); 
        return view('layouts.adviser', compact('file', 'colleges','advisers'));
    }

    public function update(Request $request, string $adviserId)
    {

        $existingName = Adviser::where('adviser_name', $request->input('adviser_name'))
        ->where('adviserId', '!=', $adviserId)
        ->first();

        if ($existingName) {
        return redirect()->back()->with('error', 'Adviser already exists!');
}
       
        $adviser = Adviser::findOrFail($adviserId); 
        $adviser->adviser_name = $request->input('adviser_name');
        $adviser->adviser_college = $request->input('adviser_college'); 
        
        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture');
            $validExtensions = ['jpg', 'jpeg', 'png'];
            $extension = $profilePicture->getClientOriginalExtension();
    
            if (!in_array(strtolower($extension), $validExtensions)) {
                return redirect()->back()->with('error', 'Please use a valid picture format (jpg, jpeg, or png).');
            }
    
            $imageName = time() . '.' . $extension;
    
            $image = Image::make($profilePicture->getRealPath())->fit(114, 120);
            $image->save('storage/advisers_pic/' . $imageName);
    
            $adviser->profile_picture = $imageName;
        }
        if ($request->input('profile_picture') === '') {
            $adviser->profile_picture = null; 
        }
        $adviser->save();
        
        return redirect()->back()->with('success', 'Adviser Updated Successfully!');
        
    }
public function destroy(string $adviserId)
    {
        $adviser = Adviser::findOrFail($adviserId);
            $adviser->delete();
            return redirect()->back()->with('success', 'Adviser deleted successfully');
    }

}