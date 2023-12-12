<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class DatabaseHelper
{
    public static function isXWEBConnected(): bool
    {
        try {
            $pdo = DB::connection('XWEB')->getPdo();
            return $pdo !== null;
        } catch (\Exception $e) {
            return false;
        }
    }
}
