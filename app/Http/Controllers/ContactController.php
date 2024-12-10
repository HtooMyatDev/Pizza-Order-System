<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $this->checkContactValidation($request);
        Contact::create([
            'user_id' => Auth::user()->id,
            'email' => Auth::user()->email,
            'title' => $request->title,
            'message' => $request->message
        ]);

        Alert::success('Complaint Send', 'Sent to Admin Sides Successfully!');
        return back();
    }

    private function checkContactValidation($request)
    {
        $validationRules = [
            'name' => 'required',
            'email' => 'required',
            'title' => 'required',
            'message' => 'required',
        ];
        $request->validate($validationRules);
    }
}
