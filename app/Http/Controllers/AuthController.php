<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Client;
use App\Exchange;
use App\Expense;
use App\Lead;
use App\Manager;
use App\MasterAttendance as AppMasterAttendance;
use App\Setting;
use App\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use MasterAttendance;

class AuthController extends Controller
{
    public function loginView(Request $req)
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



    // main dashboard
    public function dashboard()
    {


        // dates
        $today = Carbon::now()->format('Y-m-d');
        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();
        $currentWeekStart = Carbon::now()->startOfWeek();
        $currentWeekEnd = Carbon::now()->endOfWeek();
        $currentYearStart = Carbon::now()->startOfYear();
        $currentYearEnd = Carbon::now()->endOfYear();
        // total users type
        // lead project managers
        $leadManagers = User::where('role', '=', 'manager')->get()->count();
        $leadAgent = User::where('role', '=', 'agent')->get()->count();
        $todaysLeads = Lead::whereDate('created_at', '=', $today)->get()->count();
        $monthlyLeads = Lead::whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])->get()->count();
        $TotalLeads = Lead::get()->count();
        // not processeed
        $ProctodaysLeads = Lead::whereNotNull('status_id')->whereDate('created_at', '=', $today)->get()->count();
        $ProcmonthlyLeads = Lead::whereNotNull('status_id')->whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])->get()->count();
        $ProcTotalLeads = Lead::whereNotNull('status_id')->get()->count();
        //  customer care project
        // this data will be according to exchanges
        // For CRICADDA MAIN its id is 2
        $cricAddaMain = 2;
        $cricAddaF1 = 2;
        // todays
        $MaintodaysDepositAllClient = Transaction::where('exchange_id', '=', '2')->where('type', 'Deposit')->whereDate('date', $today)->get();
        $MaintodaysWithdrawAllClient = Transaction::where('exchange_id', '=', '2')->where('type', 'Withdraw')->whereDate('date', $today)->get();
        // this week
        $MainThiWeekDepositAllClient = Transaction::where('exchange_id', '=', '2')->where('type', 'Deposit')->whereDate('transactions.date', '>=', $currentWeekStart)->whereDate('transactions.date', '<=', $currentWeekEnd)->get();
        $MainThiWeekWithdrawAllClient = Transaction::where('exchange_id', '=', '2')->where('type', 'Withdraw')->whereDate('transactions.date', '>=', $currentWeekStart)->whereDate('transactions.date', '<=', $currentWeekEnd)->get();
        // this month
        $MainThiMonthDepositAllClient = Transaction::where('exchange_id', '=', '2')->where('type', 'Deposit')->whereDate('transactions.date', '>=', $currentMonthStart)->whereDate('transactions.date', '<=', $currentMonthEnd)->get();
        $MainThiMonthWithdrawAllClient = Transaction::where('exchange_id', '=', '2')->where('type', 'Withdraw')->whereDate('transactions.date', '>=', $currentMonthStart)->whereDate('transactions.date', '<=', $currentMonthEnd)->get();
        // this year
        $MainThiYearDepositAllClient = Transaction::where('exchange_id', '=', '2')->where('type', 'Deposit')->whereDate('transactions.date', '>=', $currentYearStart)->whereDate('transactions.date', '<=', $currentYearEnd)->get();
        $MainThiYearWithdrawAllClient = Transaction::where('exchange_id', '=', '2')->where('type', 'Withdraw')->whereDate('transactions.date', '>=', $currentYearStart)->whereDate('transactions.date', '<=', $currentYearEnd)->get();



        // CIRCKADDA F1
        // todays
        $F1todaysDepositAllClient = Transaction::where('exchange_id', '=', '1')->where('type', 'Deposit')->whereDate('date', $today)->get();
        $F1todaysWithdrawAllClient = Transaction::where('exchange_id', '=', '1')->where('type', 'Withdraw')->whereDate('date', $today)->get();
        // this week
        $F1ThiWeekDepositAllClient = Transaction::where('exchange_id', '=', '1')->where('type', 'Deposit')->whereDate('transactions.date', '>=', $currentWeekStart)->whereDate('transactions.date', '<=', $currentWeekEnd)->get();
        $F1ThiWeekWithdrawAllClient = Transaction::where('exchange_id', '=', '1')->where('type', 'Withdraw')->whereDate('transactions.date', '>=', $currentWeekStart)->whereDate('transactions.date', '<=', $currentWeekEnd)->get();
        // this month
        $F1ThiMonthDepositAllClient = Transaction::where('exchange_id', '=', '1')->where('type', 'Deposit')->whereDate('transactions.date', '>=', $currentMonthStart)->whereDate('transactions.date', '<=', $currentMonthEnd)->get();
        $F1ThiMonthWithdrawAllClient = Transaction::where('exchange_id', '=', '1')->where('type', 'Withdraw')->whereDate('transactions.date', '>=', $currentMonthStart)->whereDate('transactions.date', '<=', $currentMonthEnd)->get();
        // this year
        $F1ThiYearDepositAllClient = Transaction::where('exchange_id', '=', '1')->where('type', 'Deposit')->whereDate('transactions.date', '>=', $currentYearStart)->whereDate('transactions.date', '<=', $currentYearEnd)->get();
        $F1ThiYearWithdrawAllClient = Transaction::where('exchange_id', '=', '1')->where('type', 'Withdraw')->whereDate('transactions.date', '>=', $currentYearStart)->whereDate('transactions.date', '<=', $currentYearEnd)->get();



        // clients
        $clients = Client::get()->count();
        return view('Admin.Dashboard.index', compact('F1ThiYearWithdrawAllClient', 'F1ThiYearDepositAllClient', 'F1ThiMonthWithdrawAllClient', 'F1ThiMonthDepositAllClient', 'F1ThiWeekWithdrawAllClient', 'F1ThiWeekDepositAllClient', 'F1todaysWithdrawAllClient', 'F1todaysDepositAllClient', 'MainThiYearWithdrawAllClient', 'MainThiYearDepositAllClient', 'MainThiWeekWithdrawAllClient', 'MainThiWeekDepositAllClient', 'MainThiMonthWithdrawAllClient', 'MainThiMonthDepositAllClient', 'MaintodaysWithdrawAllClient', 'MaintodaysDepositAllClient', 'clients', 'leadManagers', 'leadAgent', 'todaysLeads', 'monthlyLeads', 'TotalLeads'));
    }
}
