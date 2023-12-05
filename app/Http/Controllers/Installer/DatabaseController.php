<?php

namespace App\Http\Controllers\Installer;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Helpers\DatabaseManager;
use DB;
use Illuminate\Support\Facades\Schema;

class DatabaseController extends Controller
{
    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * @param DatabaseManager $databaseManager
     */
    public function __construct(DatabaseManager $databaseManager)
    {
        $this->databaseManager = $databaseManager;
    }

    /**
     * Migrate and seed the database.
     *
     * @return \Illuminate\View\View
     */
    public function database(Request $request)
    {
        $databaseName = 'XWEBMUONLINE';
        $databasePathQuery = "SELECT SUBSTRING(physical_name, 1, CHARINDEX(N'master.mdf', LOWER(physical_name)) - 1) AS DataPath FROM sys.master_files WHERE database_id = 1 AND file_id = 1";
        $databasePathResult = DB::select($databasePathQuery);
        $databasePath = $databasePathResult[0]->DataPath;

        $databaseFilePath = $databasePath . $databaseName . '.mdf';
        $newFilePath = 'C:\\' . $databaseName . '.mdf';

        $databaseExists = DB::select("SELECT COUNT(*) as count FROM sys.databases WHERE name = '$databaseName'");

        if ($databaseExists[0]->count == 0) {
            if (file_exists($databaseFilePath)){
                DB::statement("CREATE DATABASE $databaseName ON (NAME = '$databaseName', FILENAME = '$newFilePath')");
            } else {
                DB::statement("CREATE DATABASE $databaseName");
            }

        }

        /* Version */

        /* MuEmu Season 6 */
        if ($request->input('muVersion') == 's6_muemu'){
            if (!Schema::hasColumn('Character', 'Resets')) {
                Schema::table('Character', function (Blueprint $table) {
                    $table->integer('Resets')->default(0);
                });
            }
            if (!Schema::hasColumn('Guild', 'Resets')) {
                Schema::table('Guild', function (Blueprint $table) {
                    $table->integer('Resets')->default(0);
                });
            }
        }

        $response = $this->databaseManager->migrateAndSeed();

        return redirect()->route('LaravelInstaller::final')
            ->with(['message' => $response]);
    }
}
