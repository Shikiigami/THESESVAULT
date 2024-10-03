<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\college;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class CreateAdminController extends Controller
{
    public function store(Request $request){

    $validator = Validator::make($request->all(), [
    'admin_name' => 'required|string',
    'admin_email' => [
        'required',
        'string',
        'email',
        'max:255',
        'unique:users',
        function ($attribute, $value, $fail) {
            if (!Str::endsWith($value, '@psu.palawan.edu.ph')) {
                $fail('Invalid email. Must use @psu.palawan.edu.ph');
            }
        },
    ],
    'admin_password' => ['required', 'string', 'min:8', 'confirmed'],
]);
        

        $adminEmail = $request->input('admin_email');
        $existingEmail = User::where('email', $adminEmail)->first();
        if ($existingEmail) {
            return redirect()->back()->with('error', 'Email already exist!');
        }

         $adminPassword = $request->input('admin_password');
         $adminCpassword = $request->input('admin_cpassword');

         if($adminPassword !== $adminCpassword){
            return redirect()->back()->with('error', 'Password does not match');
         }
    $admin = new User();
    $admin->name = $request->input('admin_name');
    $admin->email = $request->input('admin_email');
    $admin->role = $request->input('admin_role');
    $admin->college_id = $request->input('admin_college');
    $admin->last_login = now();
    $admin->password = Hash::make($request->input('admin_password'));
    
    if ($request->has('submit')) {
        $admin->save();
        $admin->sendEmailVerificationNotification(); 
    
        return redirect()->back()->with('success', 'Admin added successfully! Verification email sent.');
    }  
    
    }
}
