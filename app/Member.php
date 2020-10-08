<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone'
    ];

    public function trxBorrows()
    {
        return $this->hasMany(TrxBorrow::class, 'members_id', 'id');
    }
}
