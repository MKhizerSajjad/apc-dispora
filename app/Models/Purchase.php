<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $table = 'purchases';
    public static $snakeAttributes = false;

    protected $guarded;

    public function Supplier() {
        return $this->hasOne(Supplier::class, 'id', 'supplier_id');
    }

    public function Products() {
        return $this->belongsToMany(Product::class, 'purchase_products');
    }

    public function PurchaseInvestments() {
        return $this->hasMny(PurchaseInvestment::class);
    }
}
