<?php

namespace App\Models;

use Database\Factories\AdminCPFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class XWEB_WEB_INFORMATION extends Model
{
    use HasFactory;

    protected $table = 'XWEB_WEB_INFORMATION';
    protected $connection = 'XWEB';
    public $timestamps = false;

    protected static function newFactory()
    {
        return AdminCPFactory::new();
    }
}
