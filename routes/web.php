<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\doController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\VipController;
use App\Http\Controllers\xController;


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

    Route::get('panel', [AdminController::class, 'panel'])->name('panel');
    Route::post('panel', [AdminController::class, 'doPanel'])->name('panel');

    Route::get('', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('config', [AdminController::class, 'serverInformation'])->name('server-information');
    Route::post('config', [AdminController::class, 'doServerInformation']);

    Route::get('announce', [AdminController::class, 'announce'])->name('announce');
    Route::post('announce', [AdminController::class, 'doAnnounce']);

    Route::get('download', [AdminController::class, 'download'])->name('download');
    Route::post('download', [AdminController::class, 'doDownload']);
    Route::delete('download', [AdminController::class, 'downloadDelete']);

    Route::get('event', [AdminController::class, 'event'])->name('event');
    Route::post('event', [AdminController::class, 'doEvent']);
    Route::delete('event', [AdminController::class, 'eventDelete']);

    Route::get('boss', [AdminController::class, 'boss'])->name('boss');
    Route::post('boss', [AdminController::class, 'doBoss']);
    Route::delete('boss', [AdminController::class, 'bossDelete']);

    Route::get('slider', [AdminController::class, 'slider'])->name('slider');
    Route::post('slider', [AdminController::class, 'sliderUpload']);
    Route::delete('slider', [AdminController::class, 'sliderDelete']);

    Route::get('news', [AdminController::class, 'news'])->name('news');
    Route::post('news', [AdminController::class, 'newsUpload']);
    Route::delete('news', [AdminController::class, 'newsDelete']);

    Route::get('updates', [AdminController::class, 'updates'])->name('updates');
    Route::post('updates', [AdminController::class, 'updatesUpload']);
    Route::delete('updates', [AdminController::class, 'updatesDelete']);

    Route::get('events', [AdminController::class, 'events'])->name('events');
    Route::post('events', [AdminController::class, 'eventsUpload']);
    Route::delete('events', [AdminController::class, 'eventsDelete']);

    Route::get('hof', [AdminController::class, 'hof'])->name('hof');
    Route::post('hof', [AdminController::class, 'hofAdd']);

    Route::get('character', [AdminController::class, 'character'])->name('character');
    Route::post('character', [AdminController::class, 'doCharacter']);

    Route::get('reset', [AdminController::class, 'reset'])->name('reset');
    Route::post('reset', [AdminController::class, 'doReset']);

    Route::get('addstats', [AdminController::class, 'addStats'])->name('add-stats');
    Route::post('addstats', [AdminController::class, 'doAddStats']);

    Route::get('grand-reset', [AdminController::class, 'grandReset'])->name('grand-reset');
    Route::post('grand-reset', [AdminController::class, 'doGrandReset']);

    Route::get('pkclear', [AdminController::class, 'pkClear'])->name('pk-clear');
    Route::post('pkclear', [AdminController::class, 'doPkClear']);

    Route::get('rename', [AdminController::class, 'reName'])->name('rename');
    Route::post('rename', [AdminController::class, 'doReName']);

    Route::get('resetstats', [AdminController::class, 'resetStats'])->name('reset-stats');
    Route::post('resetstats', [AdminController::class, 'doResetStats']);

    Route::get('paypal', [AdminController::class, 'paypal'])->name('paypal');
    Route::post('paypal', [AdminController::class, 'doPaypal']);

    Route::get('paypal-pack', [AdminController::class, 'paypalPack'])->name('paypal-pack');
    Route::post('paypal-pack', [AdminController::class, 'doPaypalPack']);
    Route::delete('paypal-pack', [AdminController::class, 'paypalPackDelete']);

    Route::get('information', [AdminController::class, 'information'])->name('information');
    Route::post('information', [AdminController::class, 'doInformation']);

    Route::get('addinfo', [AdminController::class, 'addInfo'])->name('add-information');
    Route::post('addinfo', [AdminController::class, 'doAddInfo']);

    Route::get('vip-pack', [AdminController::class, 'vipPack'])->name('vip-pack');
    Route::post('vip-pack', [AdminController::class, 'doVipPack']);
    Route::delete('vip-pack', [AdminController::class, 'vipPackDelete']);

    Route::get('votereward', [AdminController::class, 'voteReward'])->name('vote-reward');
    Route::delete('votereward', [AdminController::class, 'voteRewardDelete']);
    Route::post('votereward', [AdminController::class, 'dpVoteReward']);

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
