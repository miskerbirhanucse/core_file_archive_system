<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    //
    public function getAllUsers()
    {
        $users = User::where('is_admin', 0)->paginate(10);

        $approved = User::where('approved', User::APPROVED)->count();
        $pending = User::where('approved', User::PENDING)->count();
        $rejected = User::where('approved', User::REJECTED)->count();
        return view('admin.all_users_page', compact('users', 'approved', 'pending', 'rejected'));
    }
    public function updateUser(Request $request, $id)
    {

        $permission_ids = Permission::whereIn('name', $request->input('permissions', []))->pluck('id');

        $role_ids = Role::whereIn('name', $request->input('roles', []))->pluck('id');

        if ($request->approved == 'on' && $request->rejected == null) {
            $approved = User::APPROVED;
        } elseif ($request->rejected == 'on' && $request->approved == null) {
            $approved = User::REJECTED;
        } else {
            $approved = User::PENDING;
        }

        $user = User::findOrFail($id);
        $user->approved = $approved;

        //
        $user->permissions()->sync($permission_ids);

        $user->roles()->sync($role_ids);
        $user->save();
        if ($user != null) {
            return redirect('/admin/users')->with('success', 'successfully');
        }
        return redirect('/admin/users')->with('error', 'Error occurred !');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit_user', compact('user'));
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id)->delete();
        if ($user) {
            return redirect('/admin/users')->with('success', 'successfully');
        }
        return redirect('/admin/users')->with('error', 'Error occurred !');
    }
}
