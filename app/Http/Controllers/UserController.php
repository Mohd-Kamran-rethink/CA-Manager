<?php

namespace App\Http\Controllers;

use App\Language;
use App\NumberRequest;
use App\State;
use App\User;
use App\Zone;
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
    
}

        
        

    
    
