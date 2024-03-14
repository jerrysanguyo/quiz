<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class superAdminController extends Controller
{
    public function superIndex(Request $request) {
        $search = $request->input('search');
        
        $query = User::query();
    
        if ($search) {
            $query->where('name', 'like', '%'.$search.'%')
                  ->orWhere('email', 'like', '%'.$search.'%');
        }
    
        $listOfUser = $query->paginate(5);
        
        return view('superAdmin.index', ['listOfUser' => $listOfUser, 'search' => $search]);
    }

    public function accCreate(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'type' => 'required',
        ]);
    
        $data['password'] = bcrypt($data['password']);
    
        $newAcc = User::create($data);
    
        return redirect()->route('superadmin-dashboard')->with('success', 'Account has been registered successfully!');
    }

    public function updateJudge(Request $request, $userId) {
        $user = User::findOrFail($userId);

        $user->type = 'judge';
        $user->save();

        return redirect()->back()->with('success', 'User role updated to Judge successfully!');
    }

    public function updateAdmin(Request $request, $userId) {
        $user = User::findOrFail($userId);

        $user->type = 'admin';
        $user->save();

        return redirect()->back()->with('success', 'User role updated to Admin successfully!');
    }

    public function deleteUser($userId) {
        $user = User::findOrFail($userId);
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully!');
    }
}
