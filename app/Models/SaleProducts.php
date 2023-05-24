<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleProducts extends Model
{
    use HasFactory;
    protected $table = 'sale_products';
    public static $snakeAttributes = false;

    protected $guarded;
    // public $timestamps = false;

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productPrices()
    {
        return $this->hasnMany(PurcahseProduct::class, 'purchase_product_id', 'id');
    }


}
