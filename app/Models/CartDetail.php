<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    use HasFactory;

    protected $table = 'cart_detail';

    protected $fillable = [
        'cart_id',
        'book_id',
        'quantity',
        'price'
    ];

    public function cart(){
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function book(){
        return $this->belongsTo(Book::class, 'book_id');
    }
}
