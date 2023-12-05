<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guild extends Model
{
    use HasFactory;

    protected $table = 'Guild';

    public static function getTopGuilds($perPage = 5)
    {
        return static::orderBy('Resets', 'desc')->paginate($perPage);
    }
}
