<?php

namespace App\Http\Controllers\User;

use DateTime;
use App\Models\User;
use App\Models\Pizza;
use App\Models\Rating;
use App\Models\Comment;
use App\Models\Topping;
use App\Models\ActionLog;
use Illuminate\Http\Request;
use App\Models\PizzaCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function userHome()
    {
        $pizzas = Pizza::orderBy('created_at', 'asc');
        if (request('categoryId')) {
            $pizzas->where('pizza_category_id', '=', request('categoryId'));
        }
        $pizzas = $pizzas->get();
        $categories = PizzaCategory::get();
        $list = Pizza::get();
        $users = User::where('role', 'user')->get();

        $admins = User::whereIn('role', ['admin', 'superadmin'])->get();
        return view('user.home', compact('pizzas', 'categories', 'list', 'users', 'admins'));
    }

    public function userMenu()
    {

        $pizzas = Pizza::orderBy('created_at', 'desc');
        if (request('categoryId')) {
            $pizzas->where('pizza_category_id', '=', request('categoryId'));
        }
        $pizzas = $pizzas->get();
        $categories = PizzaCategory::get();
        $list = Pizza::get();
        return view('user.menu', compact('pizzas', 'categories', 'list'));
    }
    public function userService()
    {
        $pizzas = Pizza::get();
        return view('user.service', compact('pizzas'));
    }

    public function userBlog()
    {
        return view('user.blog');
    }
    public function userAbout()
    {
        return view('user.about');
    }

    public function userContact()
    {
        return view('user.contact');
    }

    public function userDetails($id)
    {
        ActionLog::create([
            'user_id' => Auth::user()->id,
            'pizza_id' => $id,
            'action' => 'view'
        ]);
        $pizza = Pizza::where('pizzas.id', $id)
            ->select('pizzas.id', 'pizzas.name', 'pizzas.price', 'pizzas.photo', 'pizzas.description', 'pizza_categories.name as pizza_category', 'pizzas.pizza_category_id', 'pizzas.updated_at')
            ->leftJoin('pizza_categories', 'pizza_categories.id', 'pizzas.pizza_category_id')
            ->first();

        $toppings = Topping::where('pizza_category_id', '=', $pizza->pizza_category_id)->get();

        $pizzaList = Pizza::where('id', '!=', $id)->get();

        $comments = Comment::select('comments.id as comment_id', 'comments.user_id', 'users.name', 'comments.comment', 'comments.created_at')
            ->leftJoin('users', 'users.id', 'comments.user_id')
            ->where('comments.pizza_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        $views = ActionLog::where('pizza_id', $id)->where('action', 'view')->get();
        $views = count($views);

        $personalRating = Rating::where('user_id', Auth::user()->id)->where('pizza_id', $id)->first('rating');
        $personalRating = $personalRating == null ? 0 : $personalRating['rating'];

        $ratings = Rating::where('pizza_id', $id)->avg('rating');


        return view('user.details', compact('pizza', 'pizzaList', 'toppings', 'views', 'comments', 'ratings', 'personalRating'));
    }
}
