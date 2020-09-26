<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrxBorrow extends Model
{
    protected $fillable = [
        'members_id',
        'borrowed_at',
        'due_return_at'
    ];

    public function details()
    {
        return $this->hasMany(TrxBorrowDetail::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function trxReturn()
    {
        return $this->hasOne(TrxReturn::class);
    }
}
