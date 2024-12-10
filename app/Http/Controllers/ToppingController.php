<?php

namespace App\Http\Controllers;

use App\Models\PizzaCategory;
use App\Models\Topping;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ToppingController extends Controller
{
    public function index()
    {
        $toppings = Topping::select('toppings.id', 'toppings.topping', 'toppings.count', 'toppings.price', 'toppings.created_at', 'toppings.updated_at', 'pizza_categories.name as category')
            ->leftJoin('pizza_categories', 'toppings.pizza_category_id', '=', 'pizza_categories.id')
            ->get();
        $categories = PizzaCategory::select('id', 'name')->get();
        return view('admin.topping.index', compact('toppings', 'categories'));
    }

    public function create(Request $request)
    {
        $this->checkValidation($request);
        $topping = $this->requestToppingData($request);
        Topping::create($topping);
        return back();
    }

    public function delete($id)
    {
        Topping::select('id', $id)->delete();
        Alert::success('Deleted', 'Topping Deleted Successfully!');
        return back();
    }

    public function editPage($id)
    {
        $topping = Topping::find($id)->first();
        $categories = PizzaCategory::select('id', 'name')->get();
        return view('admin.topping.update', compact('topping','categories'));
    }

    public function edit(Request $request)
    {
        $this->checkValidation($request);
        $topping = $this->requestToppingData($request);
        Topping::find($request->toppingID)->update($topping);
        return to_route('admin#toppings');
    }
    private function requestToppingData($request)
    {
        return [
            'topping' => $request->topping,
            'count' => $request->count,
            'price' => $request->price,
            'pizza_category_id' => $request->pizza_category_id
        ];
    }
    private function checkValidation($request)
    {
        $validationRules = [
            'topping' => 'required',
            'count' => 'required|gte:0',
            'price' => 'required|gte:150',
            'pizza_category_id' => 'required',
        ];

        $request->validate($validationRules);
    }
}
