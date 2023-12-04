<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\College;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class UsersController extends Controller
{
   public function index(){
    return view('layouts.users-profile');
   }
}