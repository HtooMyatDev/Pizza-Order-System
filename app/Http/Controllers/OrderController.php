<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Topping;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    // User Side
    public function store(Request $request)
    {
        $orderArray = [];
        foreach ($request->all() as $item) {
            array_push($orderArray, [
                'user_id' => $item['user_id'],
                'pizza_id' => $item['pizza_id'],
                'count' => $item['qty'],
                'toppings' => $item['toppings'],
                'sauce' => $item['sauce'],
                'order_code' => $item['order_code'],
                'total_amt' => $item['total_amt'],
                'status' => 0,
            ]);
        }

        $request->session()->put('storeCart', $orderArray);
        return response()->json([
            'status' => 'success'
        ], 200);
    }

    public function payment(Request $request)
    {
        $payments = Payment::select('id', 'account_name', 'account_number', 'account_type')->get();
        $data = $request->session()->get('storeCart');
        return view('user.order.payment', compact('payments', 'data'));
    }

    public function order(Request $request)
    {
        $this->checkPaymentValidation($request);

        $paymentHistoryData = [
            'user_id' => Auth::user()->id,
            'order_code' => $request->orderCode,
            'phone' => $request->phone,
            'address' => $request->address,
            'total_amt' => $request->totalAmt,
            'payment_method' => $request->paymentType
        ];
        if ($request->hasFile('payslipImage')) {
            $fileName = uniqid() . $request->file('payslipImage')->getClientOriginalName();
            $request->file('payslipImage')->move(public_path() . '/payslip/', $fileName);
            $paymentHistoryData['payslipImage'] = $fileName;
        }
        PaymentHistory::create($paymentHistoryData);

        // order and delete cart

        $orderData = Session::get('storeCart');

        foreach ($orderData as $item) {
            Order::create([
                'user_id' => $item['user_id'],
                'pizza_id' => $item['pizza_id'],
                'count' => $item['count'],
                'order_code' => $item['order_code'],
                'toppings' => $item['toppings'],
                'sauce' => $item['sauce'],
                'status' => $item['status'],
            ]);

            Cart::where('user_id', $item['user_id'])->where('pizza_id', $item['pizza_id'])->delete();
        }
        return to_route('user#order#list');
    }

    public function list()
    {
        $data = Order::where('user_id', Auth::user()->id)
            ->groupBy('order_code')
            ->orderBy('created_at', 'desc')
            ->get();
        // dd($data->toArray());
        return view('user.order.list', compact('data'));
    }

    public function delete($orderCode)
    {
        Order::where('order_code', $orderCode)->delete();
        Alert::success("Order Delete", 'Order Deleted Successfully!');
        return back();
    }
    private function checkPaymentValidation($request)
    {
        $validationRules = [
            'address' => 'required',
            'phone' => 'required',
            'paymentType' => 'required',
        ];
        if ($request->paymentType != 'COD') {
            $validationRules['payslipImage'] = 'required';
        }
        $request->validate($validationRules);
    }


    // Admin Side
    public function orderList()
    {
        $orders = Order::select('users.name', 'orders.order_code', 'orders.id', 'orders.status')
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->when(request('searchKey'), function ($query) {
                $query->where('orders.order_code', 'LIKE', '%' . request('searchKey') . '%');
            })
            ->groupBy('orders.order_code')
            ->get();

        return view('admin.order.list', compact('orders'));
    }

    public function orderDetails($orderCode)
    {
        $orderData = Order::select('users.email as user_email', 'users.address as user_address', 'users.phone as user_phone', 'users.name as user_name', 'users.nickname as user_nickname', 'orders.count as pizza_count', 'orders.toppings as pizza_toppings', 'orders.sauce as pizza_sauce', 'orders.status as order_status', 'orders.order_code', 'pizzas.name as pizza_name', 'pizzas.photo as pizza_photo', 'pizzas.price as pizza_price')
            ->where('orders.order_code', $orderCode)
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->leftJoin('pizzas', 'orders.pizza_id', 'pizzas.id')
            ->get();
        $paymentHistoryData = PaymentHistory::where('order_code', $orderCode)->first();
        return view('admin.order.details', compact('paymentHistoryData', 'orderData'));
    }


    public function confirm(Request $request)
    {
        $toppings = Order::where('order_code', $request->order_code)->get();
        $tempArr = [];
        foreach ($toppings as $item) {
            array_push($tempArr, explode(' / ', $item->toppings));
        }
        for ($i = 0; $i < count($tempArr); $i++) {
            Topping::whereIn('topping', values: $tempArr[$i])->decrement('count', 1);
        }

        Order::where('order_code', $request->order_code)->update([
            'status' => 1
        ]);

        return response()->json([
            'status' => 'success'
        ], 200,);
    }


    public function reject(Request $request)
    {

        Order::where('order_code', $request->order_code)->update([
            'status' => 2
        ]);

        return response()->json([
            'status' => 'success'
        ], 200,);
    }

    public function changeStatus(Request $request)
    {
        Order::where('order_code', $request->order_code)->update([
            'status' => $request->status
        ]);

        return response()->json([
            'status' => 'success'
        ], 200,);
    }

    public function sales()
    {
        $orders = Order::select('users.name', 'orders.order_code', 'orders.id', 'orders.status')
            ->where('orders.status', 1)
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->when(request('searchKey'), function ($query) {
                $query->where('orders.order_code', 'LIKE', '%' . request('searchKey') . '%');
            })
            ->groupBy('orders.order_code')
            ->get();
        return view('admin.order.sales', compact('orders'));
    }
}
