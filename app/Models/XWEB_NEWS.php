<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class XWEB_NEWS extends Model
{
    use HasFactory;

    protected $table = 'XWEB_NEWS';
    protected $connection = 'XWEB';
    public $timestamps = true;

    public static function getNews($perPage = 5)
    {
        return static::where('specific', '=', 'news')->paginate($perPage);
    }

    public static function getEvents($perPage = 5)
    {
        return static::where('specific', '=', 'events')->paginate($perPage);
    }

    public static function getUpdates($perPage = 5)
    {
        return static::where('specific', '=', 'updates')->paginate($perPage);
    }
}
