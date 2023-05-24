<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;
    protected $table = 'donations';
    public static $snakeAttributes = false;

    protected $guarded;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
