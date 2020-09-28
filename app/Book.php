<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'description',
        'total',
        'cover_url',
        'book_categories_id'
    ];

    public function category()
    {
        return $this->belongsTo(BookCategory::class, 'book_categories_id', 'id');
    }

    public function trxBorrowDetails()
    {
        return $this->hasMany(TrxBorrowDetail::class, 'books_id', 'id');
    }
}

