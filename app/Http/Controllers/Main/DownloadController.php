<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\XWEB_DOWNLOAD;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DownloadController extends Controller
{
    public function index(): View
    {
        $lite = XWEB_DOWNLOAD::where('version', '=', 'lite')->first();
        $full = XWEB_DOWNLOAD::where('version', '=', 'full')->first();
        $liteLink = XWEB_DOWNLOAD::where('version', '=', 'lite')->get();
        $fullLink = XWEB_DOWNLOAD::where('version', '=', 'full')->get();
        $update = XWEB_DOWNLOAD::where('version', '=', 'update')->get();

        return view('download', [
            'lite' => $lite,
            'full' => $full,
            'liteLink' => $liteLink,
            'fullLink' => $fullLink,
            'update' => $update,
        ]);
    }
}
