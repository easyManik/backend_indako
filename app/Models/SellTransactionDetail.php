<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellTransactionDetail extends Model
{
    use HasFactory;
    protected $table = 'sell_transaction_detail';
    public $timestamps = false;

    protected $fillable = [
        'sell_transaction_id',
        'product_id',
        'qty',
        'uom_id',
        'price',
        'disc_1',
        'disc_2',
        'disc_amount',
        'total',
        'cogs',
    ];

    public function sellTransaction()
    {
        return $this->belongsTo(SellTransaction::class, 'sell_transaction_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function uom()
    {
        return $this->belongsTo(UomList::class, 'uom_id');
    }
}