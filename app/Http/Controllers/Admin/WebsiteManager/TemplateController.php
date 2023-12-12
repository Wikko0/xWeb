<?php

namespace App\Http\Controllers\Admin\WebsiteManager;

use App\Http\Controllers\Controller;
use App\Models\XWEB_TEMPLATE;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;

class TemplateController extends Controller
{
    public function index(): View
    {
        $viewPath = resource_path('views');
        $folders = collect(File::directories($viewPath))->map(function ($folder) use ($viewPath) {
            return str_replace($viewPath . DIRECTORY_SEPARATOR, '', $folder);
        })->reject(function ($folder) {
            return $folder === 'Admin';
        });

        return view('pages.WebsiteManager.template', ['folders' => $folders]);
    }

    public function doTemplate(Request $request): RedirectResponse
    {
        /* Validation */
        $request->validate([
            'template' => 'required',
        ]);

        /* Insert */
        XWEB_TEMPLATE::updateOrCreate(
            [],
            ['active' => $request->template]
        );

        return redirect()->back()->withSuccess('You have changed template successfully!');
    }
}
