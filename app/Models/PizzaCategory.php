<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PizzaCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
}
