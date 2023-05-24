<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $table = 'sales';
    public static $snakeAttributes = false;

    protected $guarded;
    
    public function Customer() {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    public function saleProducts()
    {
        return $this->hasMany(SaleProducts::class);
    }

    public function saleRecoveries()
    {
        return $this->hasMany(SaleRecovery::class);
    }
}
