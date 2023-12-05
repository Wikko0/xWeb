<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MEMB_INFO extends Model
{
    use HasFactory;

    protected $table = 'MEMB_INFO';

    public static function userLogin($login, $password)
    {
        return self::where('memb___id', $login)
            ->where('memb__pwd', $password)
            ->first();
    }
}
