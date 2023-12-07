<?php

use App\Http\Controllers\Admin\AddSystem\HofController;
use App\Http\Controllers\Admin\AddSystem\InformationController;
use App\Http\Controllers\Admin\AddSystem\NewsController;
use App\Http\Controllers\Admin\AddSystem\VoteController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PaymentSystem\PaypalController;
use App\Http\Controllers\Admin\ServerManager\PanelController;
use App\Http\Controllers\Admin\ServerManager\ServerInformationController;
use App\Http\Controllers\Admin\UserManager\CharacterController;
use App\Http\Controllers\Admin\UserManager\GrandResetController;
use App\Http\Controllers\Admin\UserManager\PkClearController;
use App\Http\Controllers\Admin\UserManager\RenameController;
use App\Http\Controllers\Admin\UserManager\ResetController;
use App\Http\Controllers\Admin\UserManager\ResetStatsController;
use App\Http\Controllers\Admin\UserManager\StatsController;
use App\Http\Controllers\Admin\UserManager\VipController as AdminVipController;
use App\Http\Controllers\Admin\WebsiteManager\AnnounceController;
use App\Http\Controllers\Admin\WebsiteManager\BossController;
use App\Http\Controllers\Admin\WebsiteManager\DownloadController as AdminDownloadController;
use App\Http\Controllers\Admin\WebsiteManager\EventController;
use App\Http\Controllers\Admin\WebsiteManager\SliderController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\doController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VipController;
use App\Http\Controllers\xController;
use Illuminate\Support\Facades\Route;

/* Admin Controllers */

/* Main Controllers */


/*
|--------------------------------------------------------------------------
| Main Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [xController::class, 'index'])->name('home');
Route::get('/register', [xController::class, 'register'])->name('register');
Route::get('/download', [xController::class, 'download'])->name('download');
Route::get('/ranking', [xController::class, 'ranking'])->name('ranking');
Route::get('/news', [xController::class, 'news'])->name('news');
Route::get('/login', [xController::class, 'login'])->name('login');
Route::get('/account-panel', [xController::class, 'accountPanel'])->name('account-panel');
Route::get('/information', [xController::class, 'information'])->name('information');
Route::get('/user/{username}', [xController::class, 'user'])->name('user');
Route::get('/logout', [doController::class, 'doLogout'])->name('logout');
Route::post('/register', [doController::class, 'doRegister'])->name('register');
Route::post('/login', [doController::class, 'doLogin'])->name('login');


/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::middleware('user')->group(function () {
    Route::get('/reset', [UserController::class, 'reset'])->name('reset');
    Route::post('/reset', [UserController::class, 'doReset'])->name('reset');
    Route::get('/add-stats', [UserController::class, 'addStats'])->name('add-stats');
    Route::post('/add-stats', [UserController::class, 'doAddStats'])->name('add-stats');
    Route::get('/grand-reset', [UserController::class, 'grandReset'])->name('grand-reset');
    Route::post('/grand-reset', [UserController::class, 'doGrandReset'])->name('grand-reset');
    Route::get('/clearpk', [UserController::class, 'clearPk'])->name('clear-pk');
    Route::post('/clearpk', [UserController::class, 'doClearPk'])->name('clear-pk');
    Route::get('/rename', [UserController::class, 'rename'])->name('rename');
    Route::post('/rename', [UserController::class, 'do_rename'])->name('rename');
    Route::get('/resetstats', [UserController::class, 'resetStats'])->name('reset-stats');
    Route::post('/resetstats', [UserController::class, 'doResetStats'])->name('reset-stats');
    Route::get('/buycredits', [UserController::class, 'buyCredits'])->name('buycredits');
    Route::get('/buyvip', [UserController::class, 'buyVip'])->name('buyvip');
    Route::get('/vote-reward', [UserController::class, 'voteReward'])->name('vote-reward');
    Route::post('/vote-reward', [UserController::class, 'doVoteReward'])->name('vote-reward');
});


/*
|--------------------------------------------------------------------------
| Admin Login Routes
|--------------------------------------------------------------------------
*/
Route::get('adminpanel/login', [AdminLoginController::class, 'adminLogin'])->name('adminpanel/login');
Route::post('adminpanel/login', [AdminLoginController::class, 'doAdminLogin'])->name('adminpanel/login');


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('adminpanel')->middleware('admin')->name('adminpanel/')->group(function () {
    Route::get('', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('panel', [PanelController::class, 'index'])->name('panel');
    Route::post('panel', [PanelController::class, 'doPanel'])->name('panel');

    Route::get('config', [ServerInformationController::class, 'index'])->name('server-information');
    Route::post('config', [ServerInformationController::class, 'doServerInformation']);

    Route::get('announce', [AnnounceController::class, 'index'])->name('announce');
    Route::post('announce', [AnnounceController::class, 'doAnnounce']);

    Route::get('download', [AdminDownloadController::class, 'index'])->name('download');
    Route::post('download', [AdminDownloadController::class, 'doDownload']);
    Route::delete('download', [AdminDownloadController::class, 'downloadDelete']);

    Route::get('event', [EventController::class, 'index'])->name('event');
    Route::post('event', [EventController::class, 'doEvent']);
    Route::delete('event', [EventController::class, 'eventDelete']);

    Route::get('boss', [BossController::class, 'index'])->name('boss');
    Route::post('boss', [BossController::class, 'doBoss']);
    Route::delete('boss', [BossController::class, 'bossDelete']);

    Route::get('slider', [SliderController::class, 'index'])->name('slider');
    Route::post('slider', [SliderController::class, 'sliderUpload']);
    Route::delete('slider', [SliderController::class, 'sliderDelete']);

    Route::get('news', [NewsController::class, 'news'])->name('news');
    Route::post('news', [NewsController::class, 'newsUpload']);
    Route::delete('news', [NewsController::class, 'newsDelete']);

    Route::get('updates', [NewsController::class, 'updates'])->name('updates');
    Route::post('updates', [NewsController::class, 'updatesUpload']);
    Route::delete('updates', [NewsController::class, 'updatesDelete']);

    Route::get('events', [NewsController::class, 'events'])->name('events');
    Route::post('events', [NewsController::class, 'eventsUpload']);
    Route::delete('events', [NewsController::class, 'eventsDelete']);

    Route::get('hof', [HofController::class, 'index'])->name('hof');
    Route::post('hof', [HofController::class, 'hofAdd']);

    Route::get('character', [CharacterController::class, 'index'])->name('character');
    Route::post('character', [CharacterController::class, 'doCharacter']);

    Route::get('reset', [ResetController::class, 'index'])->name('reset');
    Route::post('reset', [ResetController::class, 'doReset']);

    Route::get('addstats', [StatsController::class, 'index'])->name('add-stats');
    Route::post('addstats', [StatsController::class, 'doAddStats']);

    Route::get('grand-reset', [GrandResetController::class, 'index'])->name('grand-reset');
    Route::post('grand-reset', [GrandResetController::class, 'doGrandReset']);

    Route::get('pkclear', [PkClearController::class, 'index'])->name('pk-clear');
    Route::post('pkclear', [PkClearController::class, 'doPkClear']);

    Route::get('rename', [RenameController::class, 'index'])->name('rename');
    Route::post('rename', [RenameController::class, 'doReName']);

    Route::get('resetstats', [ResetStatsController::class, 'index'])->name('reset-stats');
    Route::post('resetstats', [ResetStatsController::class, 'doResetStats']);

    Route::get('paypal', [PaypalController::class, 'index'])->name('paypal');
    Route::post('paypal', [PaypalController::class, 'doPaypal']);

    Route::get('paypal-pack', [PaypalController::class, 'paypalPack'])->name('paypal-pack');
    Route::post('paypal-pack', [PaypalController::class, 'doPaypalPack']);
    Route::delete('paypal-pack', [PaypalController::class, 'paypalPackDelete']);

    Route::get('information', [InformationController::class, 'index'])->name('information');
    Route::post('information', [InformationController::class, 'doInformation']);

    Route::get('addinfo', [InformationController::class, 'addInfo'])->name('add-information');
    Route::post('addinfo', [InformationController::class, 'doAddInfo']);

    Route::get('vip-pack', [AdminVipController::class, 'index'])->name('vip-pack');
    Route::post('vip-pack', [AdminVipController::class, 'doVipPack']);
    Route::delete('vip-pack', [AdminVipController::class, 'vipPackDelete']);

    Route::get('votereward', [VoteController::class, 'index'])->name('vote-reward');
    Route::delete('votereward', [VoteController::class, 'voteRewardDelete']);
    Route::post('votereward', [VoteController::class, 'dpVoteReward']);

});


/*
|--------------------------------------------------------------------------
| Payment Routes
|--------------------------------------------------------------------------
*/
Route::post('/pay', [PaymentController::class, 'pay'])->name('pay');
Route::get('/success', [PaymentController::class, 'success'])->name('success');
Route::get('/error', [PaymentController::class, 'error'])->name('error');


/*
|--------------------------------------------------------------------------
| VIP System Routes
|--------------------------------------------------------------------------
*/
Route::post('/getvip', [VipController::class, 'getVip'])->name('getvip');


Route::group(['prefix' => 'install', 'as' => 'LaravelInstaller::', 'namespace' => 'App\Http\Controllers\Installer', 'middleware' => ['web', 'install']], function () {    Route::get('/', [
        'as' => 'welcome',
        'uses' => 'WelcomeController@welcome',
    ]);

    Route::get('environment', [
        'as' => 'environmentWizard',
        'uses' => 'EnvironmentController@environmentWizard',
    ]);


    Route::post('environment/saveWizard', [
        'as' => 'environmentSaveWizard',
        'uses' => 'EnvironmentController@saveWizard',
    ]);


    Route::get('requirements', [
        'as' => 'requirements',
        'uses' => 'RequirementsController@requirements',
    ]);

    Route::get('permissions', [
        'as' => 'permissions',
        'uses' => 'PermissionsController@permissions',
    ]);

    Route::get('database', [
        'as' => 'database',
        'uses' => 'DatabaseController@database',
    ]);

    Route::get('final', [
        'as' => 'final',
        'uses' => 'FinalController@finish',
    ]);
});

Route::group(['prefix' => 'update', 'as' => 'LaravelUpdater::', 'namespace' => 'App\Http\Controllers\Installer', 'middleware' => 'web'], function () {
    Route::group(['middleware' => 'update'], function () {
        Route::get('/', [
            'as' => 'welcome',
            'uses' => 'UpdateController@welcome',
        ]);

        Route::get('overview', [
            'as' => 'overview',
            'uses' => 'UpdateController@overview',
        ]);

        Route::get('database', [
            'as' => 'database',
            'uses' => 'UpdateController@database',
        ]);
    });

    // This needs to be out of the middleware because right after the migration has been
    // run, the middleware sends a 404.
    Route::get('final', [
        'as' => 'final',
        'uses' => 'UpdateController@finish',
    ]);
});
