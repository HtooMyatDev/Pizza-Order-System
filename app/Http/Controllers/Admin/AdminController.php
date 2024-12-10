<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;


class AdminController extends Controller
{
    // Admin Dashboard
    public function adminHome()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.home',compact('users'));
    }

    // Admin List Page
    public function adminList()
    {
        $admins = $this->getList(['admin', 'superadmin']);
        return view('admin.list.admin', compact('admins'));
    }

    // User List Page
    public function userList()
    {
        $users = $this->getList(['user']);
        return view('admin.list.user', compact('users'));
    }

    // Delete User & Admin Account
    public function delete($id)
    {
        $oldImage = User::select('profile')->where('id', $id)->get();
        if ($oldImage[0]['profile'] != null) {
            unlink(public_path('profile/' . $oldImage));
        }
        User::where('id', $id)->delete();
        Alert::success('Delete', 'Admin Account Deleted Successfully!');
        return back();
    }

    // Add Admin to the Team
    public function addAdminPage()
    {
        return view('admin.adminAccount.add');
    }
    public function addAdmin(Request $request)
    {
        $this->checkValidation(request: $request);
        $adminData = $this->requestAdminData($request);

        User::create($adminData);

        return to_route('admin#list');
    }
    // </>

    // Get User || Admin List
    private function getList($values)
    {
        return User::select('id', 'name', 'nickname', 'email', 'address', 'phone', 'role', 'provider')
            ->when(request('searchKey'), function ($query) {
                $query->whereAny(['name', 'email', 'address'], 'like', '%' . request('searchKey') . '%');
            })
            ->whereIn('role', $values)
            ->paginate();
    }

    private function requestAdminData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'provider' => 'simple'
        ];
    }
    private function checkValidation($request)
    {
        $validationRules = [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|same:confirmPassword',
            'confirmPassword' => 'required',
        ];

        $request->validate($validationRules);
    }
}
