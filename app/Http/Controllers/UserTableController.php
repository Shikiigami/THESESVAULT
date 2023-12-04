<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserTableController extends Controller
{
    public function index()
    {
        $paginateUser = User::count();
        $users = User::orderBy('status', 'ASC')->paginate($paginateUser);
    
        $sixMonthsAgo = Carbon::now()->subMonths(6);
        $inactiveUsers = User::where('last_login', '<', $sixMonthsAgo)->get();
    
        $oneDayAgo = Carbon::now()->subDay();
        $overrunVerifiedUsers = User::whereNull('email_verified_at')
                                    ->where('created_at', '<', $oneDayAgo)
                                    ->get();
        
        return view('layouts.user-table', compact('users', 'inactiveUsers', 'sixMonthsAgo', 'overrunVerifiedUsers','oneDayAgo'));
    }

    public function destroy(string $id)
    {
        $users = User::findOrFail($id);
            $users->delete();
            return redirect()->back()->with('success', 'User deleted successfully');
    }
    public function batchDelete()
    {
        $sixMonthsAgo = Carbon::now()->subMonths(6);
        $inactiveUsers = User::where('last_login', '<', $sixMonthsAgo)
            ->orWhereNull('last_login')
            ->get();
    
        if ($inactiveUsers->isNotEmpty()) {
            foreach ($inactiveUsers as $user) {
                $user->delete();
            }
            return redirect()->back()->with('success', 'Inactive users deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'No inactive users found.');
        }
    }

}
