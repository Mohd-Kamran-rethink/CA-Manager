<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Manager;
use App\MasterAttendance as AppMasterAttendance;
use App\Setting;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use MasterAttendance;

class AuthController extends Controller
{
    public function loginView()
    {
        if (session()->has('user')) {
            return redirect('/dashboard');
        } else {
            return view('Admin.Auth.Login');
        }
    }

    public function login(Request $req)
    {
        // Get the current date
        $allowedRoles = ['super_manager'];

        $date = Carbon::today();
        // Check if there is an entry for today and the current user

        $req->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('email', '=', $req->email)->first();
        if ($user && in_array($user->role, $allowedRoles)) {
            if (Hash::check($req->password, $user->password)) {
                session()->put('user', $user);
                return redirect('/dashboard');
            } else {
                return redirect('/')->with(['msg-error-password' => 'Invalid password']);
            }
        } else {
            return redirect('/')->with(['msg-error-username' => "Email is not registered with us"]);
        }
    }
    public function logout()
    {


        session()->remove('user');
        return redirect('/');
    }
    public function dashboard()
    {
        return view('Admin.Dashboard.index');
    }
}
