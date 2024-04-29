<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';
    public $timestamps = false;

    protected $fillable = [
        'code',
        'name',
        'color',
        'is_raw_material',
        'is_active',
        'uom_id',
        'stock'
    ];
 
    public function prices()
    {
        return $this->hasMany(ProductPrice::class);
    }
}