<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MEMB_STAT extends Model
{
    use HasFactory;

    protected $table = 'MEMB_STAT';

    public static function findByAccountId($accountId)
    {
        return static::where('memb___id', '=', $accountId)->first();
    }
}
