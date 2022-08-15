<?php

namespace App\Http\Controllers\admin;

use App\Models\Users;
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
        $users = Users::where('is_admin', 0)->paginate(10);

        $approved = Users::where('approved', Users::APPROVED)->count();
        $pending = Users::where('approved', Users::PENDING)->count();
        $rejected = Users::where('approved', Users::REJECTED)->count();
        return view('admin.all_users_page', compact('users', 'approved', 'pending', 'rejected'));
    }
    public function updateUser(Request $request, $id)
    {

        $permission_ids = Permission::whereIn('name', $request->input('permissions', []))->pluck('id');

        $role_ids = Role::whereIn('name', $request->input('roles', []))->pluck('id');

        if ($request->approved == 'on' && $request->rejected == null) {
            $approved = Users::APPROVED;
        } elseif ($request->rejected == 'on' && $request->approved == null) {
            $approved = Users::REJECTED;
        } else {
            $approved = Users::PENDING;
        }

        $user = Users::findOrFail($id);
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
        $user = Users::findOrFail($id);
        return view('admin.edit_user', compact('user'));
    }

    public function deleteUser($id)
    {
        $user = Users::findOrFail($id)->delete();
        if ($user) {
            return redirect('/admin/users')->with('success', 'successfully');
        }
        return redirect('/admin/users')->with('error', 'Error occurred !');
    }
}
