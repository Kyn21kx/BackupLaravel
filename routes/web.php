<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstrumentController;
use App\Models\Instrument; 
use App\Models\InstrumentCounter;
use App\Http\Controllers\UserController;
use App\Providers\AuthServiceProvider;

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

Route::get('/', function () {
    return view('login');
});

Route::get('/landing', function () {
	session_start();
	if (!isset($_SESSION['token']) || !AuthServiceProvider::validToken($_SESSION['token'])) {
		exit(401);
	}
    return view('welcome', [				//These two are the same length
        'itemsInSale' => Instrument::all(),
        'stocksRef' => InstrumentCounter::all()
    ]);
});

Route::get('login', [UserController::class, 'login'])->name('user.login');

Route::post('instruments/create', [InstrumentController::class, 'create'])->name('instruments.create');

Route::get('instruments/add', [InstrumentController::class, 'add'])->name('instruments.add');

Route::get('instruments/getAll', [InstrumentController::class, 'getAll'])->name('instruments.getAll');

Route::get('instruments/getCounters', [InstrumentController::class, 'getCounters'])->name('instruments.getCounters');

Route::post('instruments/buy/{id}', [InstrumentController::class, 'buy'])->name('instruments.buy');

Route::post('instruments/filter', [InstrumentController::class, 'filter'])->name('instruments.filter');

Route::post('instruments/delete/{id}', [InstrumentController::class, 'delete'])->name('instruments.delete');
