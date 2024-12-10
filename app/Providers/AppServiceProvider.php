<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Contact;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        View::composer('*', function ($view) {


            if (Auth::user()) {
                $messages = Contact::select('contacts.title', 'contacts.message', 'contacts.created_at', 'users.name', 'users.profile')
                    ->leftJoin('users', 'users.id', 'contacts.user_id')
                    ->get();
                $carts = Cart::where('user_id', Auth::user()->id)->get();
                $view->with(['messages' => $messages, 'carts' => $carts]);
            }
        });
    }
}
