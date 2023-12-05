<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $guarded;

    protected $table = 'Character';
    public $timestamps = false;

    public static function findByName($name)
    {
        return static::where('Name', $name)->first();
    }

    public static function findByNameOrFail($name)
    {
        return static::where('Name', $name)->firstOrFail();
    }

    public static function getTopCharacters($perPage = 5)
    {
        return static::orderBy('Resets', 'desc')->paginate($perPage);
    }

    public static function searchByName($name, $perPage = 15)
    {
        return static::where('Name', 'LIKE', "%{$name}%")->paginate($perPage);
    }

    public static function searchByClass($class, $perPage = 15)
    {
        return static::where('Class', $class)->paginate($perPage);
    }
}
