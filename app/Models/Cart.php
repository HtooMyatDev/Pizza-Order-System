<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pizza_id',
        'pizza_qty',
        'toppings',
        'sauce',
        'extra_notes'
    ];
}
