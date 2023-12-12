<?php
/* Admin Controllers */

use App\Http\Controllers\Admin\AddSystem\HofController;
use App\Http\Controllers\Admin\AddSystem\InformationController as AdminInformationController;
use App\Http\Controllers\Admin\AddSystem\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\AddSystem\VoteController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Login\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\PaymentSystem\PaypalController;
use App\Http\Controllers\Admin\ServerManager\PanelController;
use App\Http\Controllers\Admin\ServerManager\ServerInformationController;
use App\Http\Controllers\Admin\UserManager\CharacterController;
use App\Http\Controllers\Admin\UserManager\GrandResetController as AdminGrandResetController;
use App\Http\Controllers\Admin\UserManager\PkClearController;
use App\Http\Controllers\Admin\UserManager\RenameController as AdminRenameController;
use App\Http\Controllers\Admin\UserManager\ResetController as AdminResetController;
use App\Http\Controllers\Admin\UserManager\ResetStatsController as AdminResetStatsController;
use App\Http\Controllers\Admin\UserManager\StatsController;
use App\Http\Controllers\Admin\UserManager\VipController as AdminVipController;
use App\Http\Controllers\Admin\WebsiteManager\TemplateController;
use App\Http\Controllers\Admin\WebsiteManager\AnnounceController;
use App\Http\Controllers\Admin\WebsiteManager\BossController;
use App\Http\Controllers\Admin\WebsiteManager\DownloadController as AdminDownloadController;
use App\Http\Controllers\Admin\WebsiteManager\EventController;
use App\Http\Controllers\Admin\WebsiteManager\SliderController;
use App\Http\Controllers\Main\DownloadController;
use App\Http\Controllers\Main\HomeController;
use App\Http\Controllers\Main\InformationController;
use App\Http\Controllers\Main\LoginController;
use App\Http\Controllers\Main\NewsController;
use App\Http\Controllers\Main\RankingController;
use App\Http\Controllers\Main\RegisterController;
use App\Http\Controllers\Main\User\AccountController;
use App\Http\Controllers\Main\User\AddStatsController;
use App\Http\Controllers\Main\User\BuyController;
use App\Http\Controllers\Main\User\ClearPkController;
use App\Http\Controllers\Main\User\GrandResetController;
use App\Http\Controllers\Main\User\PaymentController;
use App\Http\Controllers\Main\User\RenameController;
use App\Http\Controllers\Main\User\ResetController;
use App\Http\Controllers\Main\User\ResetStatsController;
use App\Http\Controllers\Main\User\VipController;
use App\Http\Controllers\Main\User\VoteRewardController;
use App\Http\Controllers\Main\UserController;
use Illuminate\Support\Facades\Route;

/* Main Controllers */

/* User Controllers */


/*
|--------------------------------------------------------------------------
| Main Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'doRegister'])->name('register');

Route::get('/download', [DownloadController::class, 'index'])->name('download');

Route::get('/ranking', [RankingController::class, 'index'])->name('ranking');

Route::get('/news', [NewsController::class, 'index'])->name('news');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'doLogin'])->name('login');
Route::get('/logout', [LoginController::class, 'doLogout'])->name('logout');

Route::get('/account-panel', [AccountController::class, 'index'])->name('account-panel');

Route::get('/information', [InformationController::class, 'index'])->name('information');

Route::get('/user/{username}', [UserController::class, 'index'])->name('user');


/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::middleware('user')->group(function () {
    Route::get('/reset', [ResetController::class, 'index'])->name('reset');
    Route::post('/reset', [ResetController::class, 'doReset'])->name('reset');

    Route::get('/add-stats', [AddStatsController::class, 'index'])->name('add-stats');
    Route::post('/add-stats', [AddStatsController::class, 'doAddStats'])->name('add-stats');

    Route::get('/grand-reset', [GrandResetController::class, 'index'])->name('grand-reset');
    Route::post('/grand-reset', [GrandResetController::class, 'doGrandReset'])->name('grand-reset');

    Route::get('/clearpk', [ClearPkController::class, 'index'])->name('clear-pk');
    Route::post('/clearpk', [ClearPkController::class, 'doClearPk'])->name('clear-pk');

    Route::get('/rename', [RenameController::class, 'index'])->name('rename');
    Route::post('/rename', [RenameController::class, 'doRename'])->name('rename');

    Route::get('/resetstats', [ResetStatsController::class, 'index'])->name('reset-stats');
    Route::post('/resetstats', [ResetStatsController::class, 'doResetStats'])->name('reset-stats');

    Route::get('/buycredits', [BuyController::class, 'buyCredits'])->name('buycredits');
    Route::get('/buyvip', [BuyController::class, 'buyVip'])->name('buyvip');

    Route::get('/vote-reward', [VoteRewardController::class, 'index'])->name('vote-reward');
    Route::post('/vote-reward', [VoteRewardController::class, 'doVoteReward'])->name('vote-reward');
});


/*
|--------------------------------------------------------------------------
| Admin Login Routes
|--------------------------------------------------------------------------
*/
Route::get('adminpanel/login', [AdminLoginController::class, 'index'])->name('adminpanel/login');
Route::post('adminpanel/login', [AdminLoginController::class, 'doLogin'])->name('adminpanel/login');


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

    Route::get('template', [TemplateController::class, 'index'])->name('template');
    Route::post('template', [TemplateController::class, 'doTemplate']);


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

    Route::get('news', [AdminNewsController::class, 'news'])->name('news');
    Route::post('news', [AdminNewsController::class, 'newsUpload']);
    Route::delete('news', [AdminNewsController::class, 'newsDelete']);

    Route::get('updates', [AdminNewsController::class, 'updates'])->name('updates');
    Route::post('updates', [AdminNewsController::class, 'updatesUpload']);
    Route::delete('updates', [AdminNewsController::class, 'updatesDelete']);

    Route::get('events', [AdminNewsController::class, 'events'])->name('events');
    Route::post('events', [AdminNewsController::class, 'eventsUpload']);
    Route::delete('events', [AdminNewsController::class, 'eventsDelete']);

    Route::get('hof', [HofController::class, 'index'])->name('hof');
    Route::post('hof', [HofController::class, 'hofAdd']);

    Route::get('character', [CharacterController::class, 'index'])->name('character');
    Route::post('character', [CharacterController::class, 'doCharacter']);

    Route::get('reset', [AdminResetController::class, 'index'])->name('reset');
    Route::post('reset', [AdminResetController::class, 'doReset']);

    Route::get('addstats', [StatsController::class, 'index'])->name('add-stats');
    Route::post('addstats', [StatsController::class, 'doAddStats']);

    Route::get('grand-reset', [AdminGrandResetController::class, 'index'])->name('grand-reset');
    Route::post('grand-reset', [AdminGrandResetController::class, 'doGrandReset']);

    Route::get('pkclear', [PkClearController::class, 'index'])->name('pk-clear');
    Route::post('pkclear', [PkClearController::class, 'doPkClear']);

    Route::get('rename', [AdminRenameController::class, 'index'])->name('rename');
    Route::post('rename', [AdminRenameController::class, 'doReName']);

    Route::get('resetstats', [AdminResetStatsController::class, 'index'])->name('reset-stats');
    Route::post('resetstats', [AdminResetStatsController::class, 'doResetStats']);

    Route::get('paypal', [PaypalController::class, 'index'])->name('paypal');
    Route::post('paypal', [PaypalController::class, 'doPaypal']);

    Route::get('paypal-pack', [PaypalController::class, 'paypalPack'])->name('paypal-pack');
    Route::post('paypal-pack', [PaypalController::class, 'doPaypalPack']);
    Route::delete('paypal-pack', [PaypalController::class, 'paypalPackDelete']);

    Route::get('information', [AdminInformationController::class, 'index'])->name('information');
    Route::post('information', [AdminInformationController::class, 'doInformation']);

    Route::get('addinfo', [AdminInformationController::class, 'addInfo'])->name('add-information');
    Route::post('addinfo', [AdminInformationController::class, 'doAddInfo']);

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

/*
|--------------------------------------------------------------------------
| installer Routes
|--------------------------------------------------------------------------
*/
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
