<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class XWEB_CHARACTERS extends Model
{
    use HasFactory;

    protected $table = 'XWEB_CHARACTERS';
    protected $connection = 'XWEB';
    public $timestamps = false;
}
