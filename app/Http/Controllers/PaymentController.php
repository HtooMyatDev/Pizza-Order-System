<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    // Payment List Page
    public function index()
    {
        $payments = Payment::get();
        return view('admin.payment.index', compact('payments'));
    }

    // Payment Create
    public function create(Request $request)
    {
        $this->checkValidation($request);
        $paymentData = $this->requestPaymentData($request);
        Payment::create($paymentData);
        Alert::success('Payment Created', 'Payment Created Successfully!');
        return back();
    }

    // Payment Delete
    public function delete($id)
    {
        Payment::where('id', $id)->delete();
        return back();
    }

    // Payment Edit Page
    public function editPage($id)
    {
        $payment = Payment::where('id', $id)->select('id', 'account_name', 'account_number', 'account_type')->first();
        return view('admin.payment.update', compact('payment'));
    }

    // Payment Edit
    public function edit(Request $request)
    {
        $this->checkValidation($request);
        $paymentData = $this->requestPaymentData($request);
        Payment::where("id", $request->paymentID)->update($paymentData);
        return to_route('admin#payment');
    }
    private function checkValidation($request)
    {
        $validationRules = [
            'accountName' => 'required',
            'accountNumber' => 'required|numeric|min:11',
            'accountType' => 'required',
        ];

        $request->validate($validationRules);
    }

    private function requestPaymentData($request)
    {
        return [
            'account_name' => $request->accountName,
            'account_number' => $request->accountNumber,
            'account_type' => $request->accountType
        ];
    }
}
