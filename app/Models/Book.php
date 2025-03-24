<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'image',
        'price',
        'quantity',
        'description'
    ];

    public function categories(){
        return $this->beLongsToMany(Category::class, 'book_category', 'book_id', 'category_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
