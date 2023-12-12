<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class XWEB_TEMPLATE extends Model
{
    use HasFactory;

    protected $table = 'XWEB_TEMPLATE';
    protected $connection = 'XWEB';
    public $timestamps = false;
}
