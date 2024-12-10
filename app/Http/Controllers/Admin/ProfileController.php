<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('admin.profile.index');
    }

    public function updatePage()
    {
        return view('admin.profile.update');
    }

    public function passwordChangePage()
    {
        return view('admin.profile.passwordchange');
    }

    public function passwordChange(Request $request)
    {
        $this->checkValidation($request, 'password');
        if (Hash::check($request->currentPassword, Auth::user()->password)) {
            User::where("id", Auth::user()->id)->update([
                'password' => Hash::make($request->newPassword)
            ]);
            return to_route("admin#profile");
        }

        return back();
    }
    public function update(Request $request)
    {
        $this->checkValidation($request, 'update');
        $accountData = $this->getAccountData($request);
        if ($request->hasFile('profile')) {
            if (Auth::user()->profile != null) {
                if (file_exists(public_path('profile/' . Auth::user()->profile))) {
                    unlink(public_path('profile/' . Auth::user()->profile));
                }
            }

            $fileName = uniqid() . $request->file('profile')->getClientOriginalName();
            $request->file('profile')->move(public_path() . '/profile/', $fileName);

            $accountData['profile'] = $fileName;
        } else {
            $accountData['profile'] = Auth::user()->profile;
        }



        User::where('id', Auth::user()->id)->update($accountData);

        Alert::success('Account Update', 'Account Updated Successfully!');
        return to_route('admin#profile');
    }


    private function getAccountData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
    }
    private function checkValidation($request, $action)
    {
        if ($action == 'update') {
            $validationRules = [
                'name' => 'required',
                'email' => 'required|unique:users,email,' . Auth::user()->id,
                'phone' => 'required',
                'address' => 'required',
            ];
        } elseif ($action == 'password') {
            $validationRules = [
                'currentPassword' => 'required',
                'newPassword' => 'required|same:confirmPassword',
                'confirmPassword' => 'required',
            ];
        }
        $request->validate($validationRules);
    }
}
