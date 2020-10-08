<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    protected $fillable = ['name'];
    
    public function books()
    {
        return $this->hasMany(Book::class, 'book_categories_id', 'id');
    }
}
