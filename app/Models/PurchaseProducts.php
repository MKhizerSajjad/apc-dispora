<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseProducts extends Model
{
    use HasFactory;
    protected $table = 'purchase_products';
    public static $snakeAttributes = false;

    protected $guarded;
    public $timestamps = false;

	public function Products()
	{
		return $this->hasMany(Product::class, 'product_id');
	}

    
	// public function Products()
	// {
	// 	return $this->hasMany(Product::class, 'id', 'product_id');
	// }
    
	public function Product()
	{
		return $this->hasOne(Product::class, 'id', 'product_id');
	}
}
