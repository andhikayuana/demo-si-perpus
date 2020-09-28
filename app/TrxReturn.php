<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrxReturn extends Model
{
    protected $fillable = [
        'trx_borrows_id'
    ];

    public function trxBorrow()
    {
        return $this->belongsTo(TrxBorrow::class, 'trx_borrows_id', 'id');
    }
}
