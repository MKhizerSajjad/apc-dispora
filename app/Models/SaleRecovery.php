<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleRecovery extends Model
{
    use HasFactory;
    protected $table = 'sale_recoveries';
    public static $snakeAttributes = false;

    protected $guarded;

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
