<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{
    use HasFactory;
    protected $table = 'investors';
    public static $snakeAttributes = false;

    protected $guarded;
    
    public function investments()
    {
        return $this->hasMany(Investment::class);
    }

    public function investmentReturns()
    {
        return $this->hasMany(PurchaseInvestmentReturn::class);
    }

    public function purchaseInvestmentReturns()
    {
        return $this->hasManyThrough(PurchaseInvestmentReturn::class, Investment::class);
    }
}
