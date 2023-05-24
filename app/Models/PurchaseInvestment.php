<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseInvestment extends Model
{
    use HasFactory;
    protected $table = 'purchase_investments';
    public static $snakeAttributes = false;

    protected $guarded;
    // public $timestamps = false;
}
