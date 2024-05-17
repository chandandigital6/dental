<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\LanguageController;
use App\Http\Controllers\Dashboard\PermissionController;
use App\Http\Controllers\Dashboard\PluginController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\TrafficsController;
use App\Models\Language;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/migrate', function () {
    $exitCode = Artisan::call('migrate:fresh', ['--seed' => true]);
    if ($exitCode === 0) {
        return 'Migration successful';
    } else {
        return 'Migration failed'; // You can customize this message as needed

    }
});
Route::get('/foo', function () {
    $exitCode = Artisan::call('storage:link');
    if ($exitCode === 0) {
        return 'Success';
    } else {
        return 'Failed'; // You can customize this message as needed
    }
});

Route::get('/onlyMigrate', function () {
    $exitCode = Artisan::call('migrate');
    if ($exitCode === 0) {
        return 'Migration successful';
    } else {
        return 'Migration failed'; // You can customize this message as needed

    }
});

Route::middleware(['splade'])->group(function () {
    // Registers routes to support the interactive components...
    Route::spladeWithVueBridge();

    // Registers routes to support password confirmation in Form and Link components...
    Route::spladePasswordConfirmation();

    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();

    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();

    Route::get('/language/{code}', function ($code) {
        $language = Language::where('code', $code)->first();
        if ($language) {
            Session::put('locale', $code);
        }
        return redirect()->back();
    })->name('switch-language');

    Route::middleware(['guest', 'checkUserRegistration'])->group(function () {
        Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
        Route::post('/register', [RegisteredUserController::class, 'store']);
    });

    // Route::get('/', function () {
    //     return view('welcome', [
    //         'canLogin' => Route::has('login'),
    //         'canRegister' => Route::has('register'),
    //         'laravelVersion' => Application::VERSION,
    //         'phpVersion' => PHP_VERSION,
    //     ]);
    // });

    Route::get('/',[HomeController::class,'index'])->name('home');
    Route::get('/about',[HomeController::class,'about'])->name('about');
    Route::get('/services',[HomeController::class,'services'])->name('services');
    Route::get('/contact',[HomeController::class,'contact'])->name('contact');
    Route::get('/team',[HomeController::class,'team'])->name('team');
    Route::get('/testimonial',[HomeController::class,'testimonial'])->name('testimonial');
    Route::get('/price',[HomeController::class,'price'])->name('price');
    Route::get('/appointment',[HomeController::class,'appointment'])->name('appointment');

    Route::prefix('dashboard')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::resource('user', UserController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
        Route::resource('languages', LanguageController::class);
        Route::get('traffics', [TrafficsController::class, 'index'])->name('traffics.index');
        Route::get('traffics/logs', [TrafficsController::class, 'logs'])->name('traffics.logs');
        Route::get('error-reports', [TrafficsController::class, 'error_reports'])->name('traffics.error-reports');
        Route::get('error-reports/{report}', [TrafficsController::class, 'error_report'])->name('traffics.error-report');

        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('/', [SettingController::class, 'index'])->name('index');
            Route::put('/update', [SettingController::class, 'update'])->name('update');
        });

        Route::prefix('plugins')->name('plugins.')->group(function(){
            Route::get('/',[PluginController::class,'index'])->name('index');
            Route::get('/install',[PluginController::class,'create'])->name('create');
            Route::post('/install',[PluginController::class,'store'])->name('store');
            Route::post('/{plugin}/activate',[PluginController::class,'activate'])->name('activate');
            Route::post('/{plugin}/deactivate',[PluginController::class,'deactivate'])->name('deactivate');
            Route::post('/{plugin}/delete',[PluginController::class,'delete'])->name('delete');
        });
        Route::prefix('banner')->name('banner.')->group(function(){
            Route::get('/',[BannerController::class,'index'])->name('index');
            Route::get('/create',[BannerController::class,'create'])->name('create');
            Route::post('/store',[BannerController::class,'store'])->name('store');
            Route::get('/edit/{banner}',[BannerController::class,'edit'])->name('edit');
            Route::put('/update/{banner}',[BannerController::class,'update'])->name('update');
            Route::get('/delete/{banner}',[BannerController::class,'delete'])->name('delete');
            Route::get('/duplicate/{banner}',[BannerController::class,'duplicate'])->name('duplicate');

        });

        Route::prefix('about')->name('about.')->group(function(){
            Route::get('/',[AboutController::class,'index'])->name('index');
            Route::get('/create',[AboutController::class,'create'])->name('create');
            Route::post('/store',[AboutController::class,'store'])->name('store');
            Route::get('/edit/{about}',[AboutController::class,'edit'])->name('edit');
            Route::put('/update/{about}',[AboutController::class,'update'])->name('update');
            Route::get('/delete/{about}',[AboutController::class,'delete'])->name('delete');
            Route::get('/duplicate/{about}',[AboutController::class,'duplicate'])->name('duplicate');

        });

        Route::prefix('appointment')->name('appointment.')->group(function(){
            Route::get('/',[AppointmentController::class,'index'])->name('index');
            Route::get('/create',[AppointmentController::class,'create'])->name('create');
            Route::post('/store',[AppointmentController::class,'store'])->name('store');
            Route::get('/edit/{appointment}',[AppointmentController::class,'edit'])->name('edit');
            Route::put('/update/{appointment}',[AppointmentController::class,'update'])->name('update');
            Route::get('/delete/{appointment}',[AppointmentController::class,'delete'])->name('delete');
            Route::get('/duplicate/{appointment}',[AppointmentController::class,'duplicate'])->name('duplicate');

        });

    });
});
