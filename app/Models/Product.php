<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    public static $snakeAttributes = false;

    protected $guarded;

    public function purchase() {
        return $this->belongsToMany(Purchase::class, 'purchase_products')->withPivot(['quantity']);
    }

	public function purchaseProducts()
    {
        return $this->hasMany(PurchaseProducts::class);
    }
}
