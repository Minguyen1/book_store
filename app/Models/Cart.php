<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_price'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cart_detail(){
        return $this->hasMany(CartDetail::class);
    }
}
