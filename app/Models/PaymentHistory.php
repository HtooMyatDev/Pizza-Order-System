<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order_code',
        'phone',
        'address',
        'payslip_image',
        'payment_method',
        'total_amt'
    ];
}
