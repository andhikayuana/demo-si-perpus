<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrxBorrowDetail extends Model
{
    protected $fillable = [
        'trx_borrows_id',
        'books_id'
    ];

    public function trxBorrow()
    {
        return $this->belongsTo(TrxBorrow::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
