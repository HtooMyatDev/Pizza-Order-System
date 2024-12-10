<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\ProfileController;


Route::group(['prefix' => 'user', 'middleware' => 'user'], function () {

    Route::get('home', [UserController::class, 'userHome'])->name('user#home');

    Route::get('menu', [UserController::class, 'userMenu'])->name('user#menu');

    Route::get('service', [UserController::class, 'userService'])->name('user#service');

    Route::get('blog', [UserController::class, 'userBlog'])->name('user#blog');

    Route::get('about', [UserController::class, 'userAbout'])->name('user#about');

    Route::get('contact', [UserController::class, 'userContact'])->name('user#contact');

    Route::group(['prefix' => 'product'], function () {
        Route::get('details/{id}', [UserController::class, 'userDetails'])->name('user#details');
    });

    Route::group(['prefix' => 'cart'], function () {
        Route::get('/', [CartController::class, 'index'])->name('user#cart');
        Route::get('delete', [CartController::class, 'delete'])->name('user#cart#delete');

        Route::post('add', [CartController::class, 'addToCart'])->name('user#addToCart');
        Route::post('edit', [CartController::class, 'edit'])->name('user#cart#edit');
        Route::post('update', [CartController::class, 'update'])->name('user#cart#update');
    });

    Route::group(['prefix' => 'order'], function () {
        Route::get('store', [OrderController::class, 'store'])->name('user#order#store');

        Route::get('payment', [OrderController::class, 'payment'])->name('user#order#payment');

        Route::post('make', [OrderController::class, 'order'])->name('user#order#make');

        Route::get('delete/{orderCode}', [OrderController::class, 'delete'])->name('user#order#delete');

        Route::get('list', [OrderController::class, 'list'])->name('user#order#list');
    });

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [ProfileController::class, 'index'])->name('user#profile');


        Route::get('edit', [ProfileController::class, 'editPage'])->name('user#profile#editPage');
        Route::post('edit', [ProfileController::class, 'edit'])->name('user#profile#edit');

        Route::get('change/password', [ProfileController::class, 'changePasswordPage'])->name('user#profile#changePasswordPage');
        Route::post('change/password', [ProfileController::class, 'changePassword'])->name('user#profile#changePassword');
    });


    Route::group(['prefix' => 'action'], function () {

        Route::post('contact/send', [ContactController::class, 'send'])->name('user#contact#send');

        Route::post('comment', [CommentController::class, 'comment'])->name('user#action#comment');

        Route::get('comment/delete/{id}', [CommentController::class, 'delete'])->name('user#comment#delete');
    });

    Route::post('rating', [RatingController::class, 'rate'])->name('user#rating');
});
