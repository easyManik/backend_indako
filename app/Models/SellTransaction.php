<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellTransaction extends Model
{
    use HasFactory;
    protected $table = 'sell_transaction';
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'transaction_date',
        'customer_name',
        'is_cancelled',
        'cancelled_at',
        'is_printed',
        'printed_at',
        'sub_total',
        'disc_amount',
        'grand_total',
        'notes', 
        'qty',
        'uom_id',
        'price',
        'disc_1',
        'disc_2',
        'disc_amount',
        'total',
        'cogs',
    ];

    protected $dates = [
        'transaction_date',
        'cancelled_at',
        'printed_at',
    ];
}