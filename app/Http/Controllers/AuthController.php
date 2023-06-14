<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Client;
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



    // main dashboard
    public function dashboard()
    {
        // dates
        $today = Carbon::now()->format('Y-m-d');
        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();
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
        $totalWithdrawrers = User::where('role', '=', 'withdrawrer')->get()->count();
        $totalWithdrawrersBanker = User::where('role', '=', 'withdrawal_banker')->get()->count();
        $totalDepositers = User::where('role', '=', 'depositer')->get()->count();
        $totaldepositbanker = User::where('role', '=', 'deposit_banker')->get()->count();
        // transactions
        // todays
        $ApproveDepoistTranToday = Transaction::where('type', 'Deposit')->where('status', 'Approve')->whereDate('created_at', $today)->get();
        $ApprovedDepoistToday= $ApproveDepoistTranToday->sum('amount');
        $ApprovewithTranToday = Transaction::where('type', 'Withdraw')->where('status', 'Approve')->whereDate('created_at', $today)->get();
        $ApprovedWithdrawToday= $ApprovewithTranToday->sum('amount');
        // total
        $ApproveDepoistTranTotal = Transaction::where('type', 'Deposit')->where('status', 'Approve')->get();
        $ApprovedDepoistTotal= $ApproveDepoistTranTotal->sum('amount');
        $ApprovewithTranTotal = Transaction::where('type', 'Withdraw')->where('status', 'Approve')->get();
        $ApprovedWithdrawTotal= $ApprovewithTranTotal->sum('amount');
        
        // 
        $PendingwithTranTotal = Transaction::where('type', 'Withdraw')->where('status', 'Pending')->get();
        $PendingDepTranTotal = Transaction::where('type', 'Deposit')->where('status', 'Pending')->get();
        $todaysBonus= $ApproveDepoistTranToday->sum('bonus');
        $totalBonus= $ApproveDepoistTranTotal->sum('bonus');
        
        // 
        $internalTransfer=Expense::where('transfer_type','=','Internal')->get()->sum('amount');
        $ExpenseDebit=Expense::where('transfer_type','=','External')->where('accounting_type','=','Debit')->get()->sum('amount');
        $ExpenseCredit=Expense::where('transfer_type','=','External')->where('accounting_type','=','Credit')->get()->sum('amount');
        // clients
        $clients=Client::get()->count();
        return view('Admin.Dashboard.index', compact('clients','ExpenseCredit','ExpenseDebit','internalTransfer','PendingDepTranTotal','ApproveDepoistTranTotal','PendingwithTranTotal','ApprovewithTranTotal','todaysBonus','totalBonus','ApprovedWithdrawTotal','ApprovedDepoistTotal','ApprovedWithdrawToday','ApprovedDepoistToday','totaldepositbanker', 'totalDepositers', 'totalWithdrawrersBanker', 'totalWithdrawrers', 'leadManagers', 'leadAgent', 'todaysLeads', 'monthlyLeads', 'TotalLeads'));
    }
}
