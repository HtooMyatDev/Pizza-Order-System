<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function index()
    {
        return view('user.profile.index');
    }

    public function editPage()
    {
        return view('user.profile.update');
    }

    public function edit(Request $request)
    {
        $this->checkValidation($request, 'profile');
        $data = $this->requestUserData($request, 'profile');
        if ($request->hasFile('profile')) {
            if (Auth::user()->profile) {
                if (file_exists(public_path('profile/' . Auth::user()->profile))) {
                    unlink(public_path('profile/' . Auth::user()->profile));
                }
            }
            $fileName = uniqid() . $request->file('profile')->getClientOriginalName();
            $request->file('profile')->move(public_path() . '/profile/', $fileName);

            $data['profile'] = $fileName;
        } else {
            $data['profile'] = Auth::user()->profile;
        }

        User::where('id', Auth::user()->id)->update($data);
        Alert::success('Profile Updated', 'Profile Updated Successfully!');
        return to_route('user#profile');
    }

    public function changePasswordPage()
    {
        return view('user.profile.changepassword');
    }

    public function changePassword(Request $request)
    {
        $this->checkValidation($request, 'password');
        if (Auth::user()->password != null) {
            if (Hash::check($request->currentPassword, Auth::user()->password)) {
                User::where('id', Auth::user()->id)->update([
                    'password' => Hash::make($request->newPassword)
                ]);
            }
        } else {
            User::where('id', Auth::user()->id)->update([
                'password' => Hash::make($request->newPassword)
            ]);
        }

        Alert::success('Password Changed', 'Password Changed Successfully!');
        return to_route('user#profile');
    }

    private function requestUserData($request, $action)
    {
        if ($action == 'profile') {
            return [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ];
        }
    }
    private function checkValidation($request, $action)
    {
        if ($action == 'profile') {
            $validationRules = [
                'name' => 'required',
                'email' => 'required|unique:users,email,' . Auth::user()->id,
                'phone' => 'required|unique:users,phone,' . Auth::user()->id,
                'address' => 'required',
            ];
        } else {
            $validationRules = [
                'newPassword' => 'required|same:confirmPassword',
                'confirmPassword' => 'required',
            ];
            if (Auth::user()->password != null) {
                $validationRules['currentPassword'] = 'required';
            }
        }

        $request->validate($validationRules);
    }
}
