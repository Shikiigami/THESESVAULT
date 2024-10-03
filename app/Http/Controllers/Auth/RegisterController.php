<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\recentLogin;
use App\Models\college;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

    
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::DASHBOARD;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'ends_with:@psu.palawan.edu.ph'],
            'college' => 'required',
            'program' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'profile_picture' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg|max:5120'
            ],
        ], [
            'email.ends_with' => 'Please use only PSU corporate email',
        ]);
    }
    
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    
    protected function create(array $data)
    {
        $profilePicturePath = null;
    
        if (isset($data['profile_picture']) && $data['profile_picture'] instanceof UploadedFile) {
            $profilePicture = $data['profile_picture'];
    
            $imageName = time() . '.' . $profilePicture->getClientOriginalExtension();
    
            $profilePicture->move('storage/pictures', $imageName);
    
            $profilePicturePath =  $imageName;
        }
    
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'college_id' => $data['college'],
            'program' => $data['program'],
            'profile_picture' => $profilePicturePath,
            'last_login' => now(),
            'status' => 'active',
        ]);

        $recentLogin = new recentLogin();
        $recentLogin->idUser = $user->id;
        $recentLogin->login_time = now();
        $recentLogin->save();

        return $user;
    }
    

}
