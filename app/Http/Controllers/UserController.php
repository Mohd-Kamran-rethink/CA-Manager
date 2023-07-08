<?php

namespace App\Http\Controllers;

use App\BankDetail;
use App\Client;
use App\Language;
use App\NumberRequest;
use App\State;
use App\Transaction;
use App\TransactionHistory;
use App\User;
use App\Zone;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function addView(Request $req)
    {
        $id = $req->query('id');
        if ($id) {
            $manager = User::where("role", '=', 'manager')->find($id);
            return view('Admin.Users.add', compact('manager'));
        } else {
            return view('Admin.Users.add');
        }
    }
    public function listManager(Request $req)
    {
        $allowedRoles = ['customer_care_manager', 'manager', 'expense_manager'];
        $searchTerm = $req->query('table_search');
        $users = User::whereIn('role', $allowedRoles)
            ->when($searchTerm, function ($query) use ($searchTerm) {
                $query->where(function ($query) use ($searchTerm) {
                    $query->where('name', 'like', '%' . $searchTerm . '%')
                        ->orWhere('email', 'like', '%' . $searchTerm . '%')
                        ->orWhere('phone', 'like', '%' . $searchTerm . '%');
                });
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('Admin.Users.list', compact('users','searchTerm'));
    }
    

        
        

   
    // common functions for manager and agents
    public function add(Request $req)
    {
        $rules=[
            'name' => 'required|unique:users,name',
            'phone' => 'required|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|same:confirmPassword',
            'confirmPassword' => 'required|'
        ];
       
        if (session('user')->role=='manager' && $req->role=='agent') {
            $rules['language'] = 'required|not_in:0';
            $rules['zone'] = 'required|not_in:0';
            $rules['state'] = 'required|not_in:0';
            $rules['lead_type'] = 'required|not_in:0';
            $rules['agent_type'] = 'required|not_in:0';
        }
        $req->validate($rules);

        $user = new User();
        $user->name = $req->name;
        $user->phone = $req->phone;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->role = $req->roles;
        $user->language=$req->language;
        $user->zone=$req->zone;
        $user->state=$req->state;
        $user->lead_type=$req->lead_type;
        $user->agent_type=$req->agent_type;
        $result = $user->save();
        if ($result) {
            return redirect('/users')->with(['msg-success' => 'User has been added.']);
            } else {
                return redirect('/users')->with(['msg-error'=>'Somthging went wrong']);   
            }
    }
    public function edit(Request $req)
    {
        $currentManager = User::where("role", '=', $req->role)->find($req->userId);

        $rules = [
            'name' => 'required|unique:users,name,' . $currentManager->id,
            'phone' => 'required|unique:users,phone,' . $currentManager->id,
            'email' => 'required|email|unique:users,email,' . $currentManager->id,
            'confirmPassword' => 'required_with:password',
        ];
       
        $conditionalRules = [
            'password' => 'nullable|min:8|same:confirmPassword',
            'zone' => 'required|not_in:0',
            'language' => 'required|not_in:0',
            'state' => 'required|not_in:0',
            'lead_type' => 'required|not_in:0',
            'agent_type' => 'required|not_in:0',
        ];

        $req->validate(array_merge($rules, $conditionalRules));

        $currentManager->name = $req->name;
        $currentManager->phone = $req->phone;
        $currentManager->email = $req->email;
        $currentManager->state = $req->state;
        $currentManager->zone = $req->zone;
        $currentManager->language = $req->language;
        $currentManager->lead_type=$req->lead_type;
        $currentManager->agent_type=$req->agent_type;
        if ($req->password) {
            $currentManager->password = Hash::make($req->password);
        }
        $result = $currentManager->save();
        if ($result) {
            return redirect('/users')->with(['msg-success' => 'User has been added.']);
            } else {
                return redirect('/users')->with(['msg-error'=>'Somthging went wrong']);   
            }
    }
    public function delete(Request $req)
    {

        $User = User::find($req->deleteId);
        $result = $User->delete();
        if ($result) {
            return redirect('/users')->with(['msg-success' => 'User has been added.']);
            } else {
                return redirect('/users')->with(['msg-error'=>'Somthging went wrong']);   
            }
    }
    public function clientList(Request $req)
    {
        $filterData = $req->query('filterData');
        $clients = [];
        $searchTerm = $req->query('table_search');
        $clientsQuery = Client::leftJoin('users', 'clients.agent_id', 'users.id')
                        ->when($searchTerm, function ($query, $searchTerm) {
                            $query->where(function ($query) use ($searchTerm) {
                                $query->where('clients.ca_id', 'like', '%' . $searchTerm . '%')
                                    ->orWhere('clients.number', 'like', '%' . $searchTerm . '%');
                            });
                        })
            ->select('clients.*', "users.name as agent_name");
        if ($filterData === 'all' || !$filterData) {
            $clients = $clientsQuery->paginate(20);
        } elseif ($filterData === 'without_agent') {
            $clients = $clientsQuery->whereNull('agent_id')->paginate(20);
        }

        foreach ($clients as $client) {
            $lastDeposit = Transaction::where('client_id', $client->id)
                ->where('type', 'deposit')
                ->latest('created_at')
                ->first();

            $lastWithdrawal = Transaction::where('client_id', $client->id)
                ->where('type', 'withdraw')
                ->latest('created_at')
                ->first();  

            $client->lastDepositDate = $lastDeposit ? $lastDeposit->created_at : null;
            $client->lastWithdrawalDate = $lastWithdrawal ? $lastWithdrawal->created_at : null;
            if ($client->lastDepositDate) {
                $client->lastDepositDaysAgo = Carbon::parse($client->lastDepositDate)->diffInDays(Carbon::now());
            }

            if ($client->lastWithdrawalDate) {
                $client->lastWithdrawalDaysAgo = Carbon::parse($client->lastWithdrawalDate)->diffInDays(Carbon::now());
            }
        }
        $agents = User::where('role', '=', 'agent')->get();
        return view('Admin.Client.list', compact('clients', 'agents', 'filterData','searchTerm'));
    }
    public function showClientActivity(Request $req)
    {
        $id = $req->query('id');
        $startDate = $req->query('from_date') ?? null;
        $endDate = $req->query('to_date') ?? null;
        $type = $req->query('type') ?? 'null';
        if (!$startDate) {
            $startDate = Carbon::now()->startOfDay();
            $endDate = Carbon::now()->endOfDay();
        } else {
            $startDate = Carbon::createFromFormat('Y-m-d', $startDate)->startOfDay();
            $endDate = Carbon::createFromFormat('Y-m-d', $endDate)->endOfDay();
        }

        $activites = TransactionHistory::where('client_id', '=', $id)
                ->when($type !== 'null', function ($query) use ($type) {
                    $query->where('type', $type);
                })
            ->whereDate('created_at', '>=', date('Y-m-d', strtotime($startDate)))
            ->whereDate('created_at', '<=', date('Y-m-d', strtotime($endDate)))
            ->get();
        $startDate = $startDate->toDateString();
        $endDate = $endDate->toDateString();
        return view('Admin.Client.ViewDetails', compact('activites', 'id', 'startDate', 'endDate'));
    }
    public function clientHistory(Request $req)
    {

        $html = '';
        $lastWithdraw = Transaction::where('Type', '=', 'Withdraw')->where('client_id', '=', $req->clientID)->latest()
            ->limit(5)->get();
        $lastDeposit = Transaction::where('Type', '=', 'Deposit')->where('client_id', '=', $req->clientID)->latest()
            ->limit(5)->get();

        $html .= '<div class="container">';
        $html .= '<div class="row">';

        $html .= '<div class="col-6">';
        $html .= '<h2>Last Withdrawals:</h2>';
        $html .= '<table class="table">';
        $html .= '<tr><th>Amount</th><th>Date</th></tr>';

        foreach ($lastWithdraw as $withdraw) {
            $html .= '<tr>';
            $html .= '<td>' . $withdraw->amount . '</td>';
            $html .= '<td>' . $withdraw->date . '</td>';
            // Add any other details you want to display
            $html .= '</tr>';
        }

        $html .= '</table>';
        $html .= '</div>'; // Close col-6

        $html .= '<div class="col-6">';
        $html .= '<h2>Last Deposits:</h2>';
        $html .= '<table class="table">';
        $html .= '<tr><th>Amount</th><th>Date</th></tr>';

        foreach ($lastDeposit as $deposit) {
            $html .= '<tr>';
            $html .= '<td>' . $deposit->amount . '</td>';
            $html .= '<td>' . $deposit->date . '</td>';
            // Add any other details you want to display
            $html .= '</tr>';
        }

        $html .= '</table>';
        $html .= '</div>'; // Close col-6

        $html .= '</div>'; // Close row
        $html .= '</div>'; // Close container

        return $html;
    }
    public function viewBankList(Request $req)
    {
        $id = $req->query('id');
        $banks = BankDetail::where('customer_id', '=', $id)->get();
        return view('Admin.Client.BankList', compact('banks'));
    }
}

        
        

    
    
