<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;
    protected $table = 'investments';
    public static $snakeAttributes = false;

    protected $guarded;
    
    // public function Investor() {
    //     return $this->hasOne(Investor::class, 'id', 'investor_id');
    // }
    
    // public function Investor() {
    //     return $this->belongsTo(Investor::class);
    // }

    // public function InvestmentReturns()
    // {
    //     return $this->hasMany(PurchaseInvestmentReturn::class);
    // }

    public function investor()
    {
        return $this->belongsTo(Investor::class);
    }

    public function purchaseInvestmentReturns()
    {
        return $this->hasMany(PurchaseInvestmentReturn::class, 'investment_id', 'id');
    }

    public function purchaseInvestments()
    {        
        return $this->hasMany(PurchaseInvestment::class);
    }
}
