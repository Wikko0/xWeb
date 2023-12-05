<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class XWEB_CREDITS extends Model
{
    use HasFactory;

    protected $guarded;

    protected $table = 'XWEB_CREDITS';
    protected $connection = 'XWEB';
    public $timestamps = false;

    public static function findByAccount($name)
    {
        return static::where('name', $name)->first();
    }
}
