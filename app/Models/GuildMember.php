<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuildMember extends Model
{
    use HasFactory;

    protected $table = 'GuildMember';

    public static function getGuildByUsername($username)
    {
        return self::where('Name', $username)->first();
    }
}
