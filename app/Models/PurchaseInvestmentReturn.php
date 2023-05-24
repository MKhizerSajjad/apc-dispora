<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseInvestmentReturn extends Model
{
    use HasFactory;
    protected $table = 'purchase_investment_returns';
    public static $snakeAttributes = false;

    protected $guarded;

    
    // public function Investor() {
    //     return $this->belongsTo(Investor::class);
    // }
    
    // public function investment()
    // {
    //     return $this->belongsTo(Investment::class, 'investment_id');
    // }


    public function investment()
    {
        return $this->belongsTo(Investment::class);
    }

    public function investor()
    {
        return $this->belongsTo(Investor::class);
    }

}
