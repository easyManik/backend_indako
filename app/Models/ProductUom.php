<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductUom extends Model
{
    protected $table = 'product_uoms';
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'uom_id',
        'qty_conversion',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function uom()
    {
        return $this->belongsTo(UOMList::class, 'uom_id');
    }
}