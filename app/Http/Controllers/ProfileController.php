<?php

namespace App\Http\Controllers;
use Intervention\Image\Facades\Image;
use App\Models\User;
use App\Models\college;
use App\Models\AuditTrail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
class ProfileController extends Controller

{
    public function editProfile()
    {
        $colleges = college::all();
        return response()->json($colleges);
    }
    
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // Store the current user data for comparison
        $oldUserData = [
        'name' => $user->name,
        'email' => $user->email,
        'program' => $user->program,
        'college_id' => $user->college_id,
        'interest' => $user->interest,
        'profile_picture' => $user->profile_picture,
    ];
    
        // Update user data
        $user->name = $request->input('name');
        $user->program = $request->input('program');
        $user->college_id = $request->input('college_id');
        $user->interest = $request->input('interest');

    
        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture');
            $validExtensions = ['jpg', 'jpeg', 'png'];
            $extension = $profilePicture->getClientOriginalExtension();
    
            if (!in_array(strtolower($extension), $validExtensions)) {
                return redirect()->back()->with('error', 'Please use a valid picture format (jpg, jpeg, or png).');
            }
    
            $imageName = time() . '.' . $extension;
    
            $image = Image::make($profilePicture->getRealPath())->fit(360, 360);
            $image->save('storage/pictures/' . $imageName);
    
            $user->profile_picture = $imageName;
        }
        if ($request->input('profile_picture') === '') {
            $user->profile_picture = null; 
        }
    
        $user->save();
        

    $changes = [];
    
    foreach ($oldUserData as $key => $oldValue) {
        $newValue = $user->{$key};
        if ($oldValue !== $newValue) {
            $changes[$key] = [
                'old' => $oldValue,
                'new' => $newValue,
            ];
        }
    }
    // Insert the audit trail record into the database
    AuditTrail::create([
        'user_id' => $user->id,
        'action' => 'Profile Updated',
        'changes' => json_encode($changes),
    ]);
    
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function changePassword(Request $request){

        $user = Auth::user();
        $oldUserData = [
            'password' => $user->password,
        ];
       
        $password = $user->password;
        $mypassword = $request->input('password');
        $newpassword = $request->input('newpassword');
        $renewpassword = $request->input('renewpassword');
    
        if (!Hash::check($mypassword, $password)) {
            return redirect()->back()->with('error', 'Incorrect current password');
        }
        elseif (strlen($newpassword) < 8 || strlen($renewpassword) < 8) {
            return redirect()->back()->with('error', 'Password must be at least 8 characters.');
        }
        elseif ($newpassword !== $renewpassword){
            return redirect()->back()->with('error', 'Password did not match');
        }
        else {
            $user->password = bcrypt($newpassword);
            $user->save();

            $changes = [];
            foreach ($oldUserData as $key => $oldValue) {
                $newValue = $user->{$key};
                if ($oldValue !== $newValue) {
                    $changes[$key] = [
                        'old' => $oldValue,
                        'new' => $newValue,
                    ];
                }
            }
            AuditTrail::create([
                'user_id' => $user->id,
                'action' => 'Profile Updated',
                'changes' => 'Password Change',
            ]);
            return redirect()->back()->with('success', 'Password updated successfully');
        }
    }
    
    public function logout(){
        return view('auth.login');
       }
 
}
