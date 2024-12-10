<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Pizza;
use App\Models\Topping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function index()
    {
        $products = Pizza::select('carts.id as cart_id', 'pizzas.id as pizza_id', 'pizzas.photo', 'pizzas.name', 'pizzas.price', 'carts.pizza_qty as qty', 'carts.toppings','carts.sauce')
            ->leftJoin('carts', 'pizzas.id', 'carts.pizza_id')
            ->where('carts.user_id', Auth::user()->id)
            ->get();

        $total = 0;
        $toppings = Topping::select('price', 'topping')->get();
        foreach ($products as  $product) {
            $total += $product['qty'] * $product['price'];
        }
        $toppingPrice = [];
        foreach ($products as  $product) {
            $toppingArr = explode(' / ', $product->toppings);
            for ($i = 0; $i < count($toppingArr); $i++) {
                for ($j = 0; $j < count($toppings); $j++) {
                    if ($toppingArr[$i] == $toppings[$j]->topping) {
                        array_push($toppingPrice, $toppings[$j]->price);
                    }
                }
            }
        }
        $total += array_sum($toppingPrice);
        return view('user.cart.index', compact('products', 'toppings', 'total'));
    }


    public function addToCart(Request $request)
    {
        $this->checkValidation($request);
        $data = $this->requestData($request);
        if ($request->toppings != null) {
            $data['toppings'] = implode(' / ', $request->toppings);
        }
        Cart::create($data);
        Alert::success('Added to Cart', 'Added to the Cart Successfully!');
        return to_route('user#cart');
    }

    // Jquery ajax method call
    public function delete(Request $request)
    {
        $cartId = $request->cartId;
        Cart::where('id', $cartId)->delete();
        Alert::success('Cart Delete', 'Cart has been deleted successfully!');
        return response()->json([
            'status' => 'success'
        ], 200);
    }

    // Form post method call
    public function edit(Request $request)
    {
        $cartId = $request->cartId;
        $data = Cart::select('carts.id as cart_id', 'pizzas.photo', 'pizzas.name', 'pizzas.price', 'carts.pizza_qty as qty', 'carts.toppings', 'pizzas.pizza_category_id', 'carts.sauce', 'carts.extra_notes')
            ->where('carts.id', $cartId)
            ->leftJoin('pizzas', 'pizzas.id', 'carts.pizza_id')
            ->first();

        $pizzaCat = $data->pizza_category_id;
        $toppings = Topping::select('price', 'topping')
            ->where('pizza_category_id', $pizzaCat)
            ->get();
        $selectedToppings = explode(' / ', $data->toppings);
        return view('user.cart.edit', compact('data', 'toppings', 'selectedToppings'));
    }

    public function update(Request $request)
    {
        $data = [
            'pizza_qty' => $request->quantity,
            'sauce' => $request->sauce,
            'extra_notes' => $request->extraNotes,
        ];
        if ($request->toppings != null) {
            $data['toppings'] = implode(' / ', $request->toppings);
        } else {
            $data['toppings'] = null;
        }

        Cart::where('id', $request->cartId)->update($data);
        Alert::success('Cart Update', 'Cart Updated Successfully!');
        return to_route('user#cart');
    }
    private function requestData($request)
    {
        return [
            'user_id' => $request->userID,
            'pizza_id' => $request->pizzaID,
            'pizza_qty' => $request->quantity,
            'sauce' => $request->sauce,
            'extra_notes' => $request->extraNotes,
        ];
    }
    private function checkValidation($request)
    {
        $validationRules = [
            'sauce' => 'required',
        ];

        $request->validate($validationRules);
    }
}
