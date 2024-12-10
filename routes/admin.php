<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ToppingController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\PizzaCategoryController;

Route::group(["prefix" => "admin", "middleware" => "admin"], function () {
    // Admin Home
    Route::get("home", [AdminController::class, "adminHome"])->name(
        "admin#home"
    );

    // Admin List
    Route::get("list", [AdminController::class, "adminList"])->name(
        "admin#list"
    );
    Route::get("delete/{id}", [AdminController::class, "delete"])->name(
        "admin#delete"
    );

    // Profile Settings
    Route::get("profile", [ProfileController::class, "profile"])->name(
        "admin#profile"
    );
    Route::get("profile/update", [
        ProfileController::class,
        "updatePage",
    ])->name("admin#profile#updatePage");
    Route::post("profile/update", [ProfileController::class, "update"])->name(
        "admin#profile#update"
    );

    // Password Change
    Route::get("change/password", [
        ProfileController::class,
        "passwordChangePage",
    ])->name("admin#profile#changePasswordPage");
    Route::post("change/password", [
        ProfileController::class,
        "passwordChange",
    ])->name("admin#profile#changePassword");

    // Add New Admin to Team
    Route::group(["middleware" => "superadmin"], function () {
        // Add Admin
        Route::get("add/account", [
            AdminController::class,
            "addAdminPage",
        ])->name("admin#add#accountPage");
        Route::post("add/account", [AdminController::class, "addAdmin"])->name(
            "admin#add#account"
        );

        // Add Payment

        Route::group(["prefix" => "payment"], function () {
            Route::get("/", [PaymentController::class, "index"])->name(
                "admin#payment"
            );
            Route::post("create", [PaymentController::class, "create"])->name(
                "admin#payment#create"
            );
            Route::get("delete/{id}", [
                PaymentController::class,
                "delete",
            ])->name("admin#payment#delete");
            Route::get("edit/{id}", [
                PaymentController::class,
                "editPage",
            ])->name("admin#payment#editPage");
            Route::post("edit", [PaymentController::class, "edit"])->name(
                "admin#payment#edit"
            );
        });
    });

    Route::group(["prefix" => "user"], function () {
        //  User List
        Route::get("list", [AdminController::class, "userList"])->name(
            "admin#user#list"
        );
        Route::get("delete/{id}", [AdminController::class, "delete"])->name(
            "admin#user#delete"
        );
    });

    // Topping
    Route::group(["prefix" => "topping"], function () {
        Route::get("/", [ToppingController::class, "index"])->name(
            "admin#toppings"
        );
        Route::post("create", [ToppingController::class, "create"])->name(
            "admin#toppings#create"
        );
        Route::get("delete/{id}", [ToppingController::class, "delete"])->name(
            "admin#toppings#delete"
        );
        Route::get("edit/{id}", [ToppingController::class, "editPage"])->name(
            "admin#toppings#editPage"
        );
        Route::post("edit", [ToppingController::class, "edit"])->name(
            "admin#toppings#edit"
        );
    });

    // Category

    Route::group(["prefix" => "category"], function () {
        Route::get("/", [PizzaCategoryController::class, "index"])->name(
            "admin#categories"
        );
        Route::post("create", [PizzaCategoryController::class, "create"])->name(
            "admin#categories#create"
        );
        Route::get("edit/{id}", [
            PizzaCategoryController::class,
            "editPage",
        ])->name("admin#categories#editPage");
        Route::post("edit", [PizzaCategoryController::class, "edit"])->name(
            "admin#categories#edit"
        );
    });

    Route::group(["prefix" => "pizza"], function () {
        Route::get("/", [PizzaController::class, "index"])->name(
            "admin#pizzas"
        );
        Route::post("create", [PizzaController::class, "create"])->name(
            "admin#pizzas#create"
        );
        Route::post("delete", [PizzaController::class, "delete"])->name(
            "admin#pizzas#delete"
        );
        Route::get("edit/{id}", [PizzaController::class, "editPage"])->name(
            "admin#pizzas#editPage"
        );
        Route::post("edit", [PizzaController::class, "edit"])->name(
            "admin#pizzas#edit"
        );
    });
    Route::group(['prefix' => 'order'], function () {
        Route::get('list', [OrderController::class, 'orderList'])->name('admin#order#list');

        Route::get('details/{order_code}', [OrderController::class, 'orderDetails'])->name('admin#order#details');

        Route::get('confirm', [OrderController::class, 'confirm'])->name('admin#order#confirm');

        Route::get('reject', [OrderController::class, 'reject'])->name('admin#order#reject');

        Route::get('changeStatus', [OrderController::class, 'changeStatus'])->name('admin#order#changeStatus');

        Route::get('sales', [OrderController::class, 'sales'])->name('admin#order#success');
    });

});
