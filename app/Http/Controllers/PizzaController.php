<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;
use App\Models\PizzaCategory;
use RealRashid\SweetAlert\Facades\Alert;



class PizzaController extends Controller
{
    public function index()
    {
        $pizzas = Pizza::select('pizzas.id', 'pizzas.name', 'pizzas.price', 'pizzas.photo', 'pizzas.pizza_category_id', 'pizza_categories.name as category_name', 'pizzas.created_at', 'pizzas.updated_at')
            ->leftJoin('pizza_categories', 'pizza_categories.id', '=', 'pizzas.pizza_category_id')
            ->get();
        $categories = PizzaCategory::select('id', 'name')->get();
        return view('admin.pizza.index', compact('pizzas', 'categories'));
    }

    public function create(Request $request)
    {
        $this->checkValidation($request, 'create');
        $pizzaData =  $this->requestPizzaData($request);
        if ($request->hasFile('photo')) {
            $fileName = uniqid() . '_' . $request->file('photo')->getClientOriginalName();
            $request->file('photo')->move(public_path() . '/pizza/', $fileName);

            $pizzaData['photo'] = $fileName;
        }

        Pizza::create($pizzaData);
        return back();
    }

    public function editPage($id)
    {
        $pizza = Pizza::where('id', $id)->first();
        $categories = PizzaCategory::select('id', 'name')->get();
        return view('admin.pizza.edit', compact('pizza', 'categories'));
    }

    public function edit(Request $request)
    {
        $this->checkValidation($request, 'update');
        $pizzaData = $this->requestPizzaData($request);
        $oldImage = $request->oldImage;
        if ($request->hasFile('photo')) {
            if (file_exists(public_path() . '/pizza/' . $oldImage)) {
                unlink(public_path() . '/pizza/' . $oldImage);
            }
            $fileName = uniqid() . $request->file('photo')->getClientOriginalName();
            $request->file('photo')->move(public_path('pizza/'), $fileName);

            $pizzaData['photo'] = $fileName;
        } else {
            $pizzaData['photo'] = $oldImage;
        }
        Pizza::where('id', $request->pizzaID)->update($pizzaData);
        Alert::success('Updated', "Pizza Updated Successfully!");
        return to_route('admin#pizzas');
    }

    public function delete(Request $request)
    {
        unlink(public_path() . '/pizza/' . $request->pizzaImage);
        Pizza::where('id', $request->pizzaID)->delete();
        return back();
    }
    private function requestPizzaData($request)
    {
        return [
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'pizza_category_id' => $request->pizza_category_id,
        ];
    }

    private function checkValidation($request, $action)
    {
        if ($action == 'update') {
            $validationRules = [
                'name' => 'required',
                'price' => 'required|numeric',
                'description' => 'required',
                'pizza_category_id' => 'required',
            ];
        } else {
            $validationRules = [
                'photo' => 'required',
                'name' => 'required',
                'price' => 'required|numeric',
                'description' => 'required',
                'pizza_category_id' => 'required',
            ];
        }

        $validationMessages = [
            'pizza_category_id.required' => 'The pizza category field is required.'
        ];

        $request->validate($validationRules, $validationMessages);
    }
}
