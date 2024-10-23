<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\TandingController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TimController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// putra
Route::get('/match', [MatchController::class, 'create'])->name('match.create');
Route::post('/match', [MatchController::class, 'store'])->name('match.store');
Route::delete('/match/{match}', [MatchController::class, 'destroy'])->name('match.destroy');
Route::get('/list_match', [MatchController::class, 'index'])->name('match.index');
// end putra

// klasemen putra
Route::get('/team', [TeamController::class, 'index'])->name('team.index');
Route::get('/team/export/excel', [TeamController::class, 'export_excel']);
Route::get('team/view/pdf', [TeamController::class, 'view_pdf'])->name('team.view_pdf');
Route::get('team/download/pdf', [TeamController::class, 'download_pdf'])->name('team.download_pdf');
// end klasemen putra

// putri
Route::get('/tanding', [TandingController::class, 'create'])->name('tanding.create');
Route::post('/tanding', [TandingController::class, 'store'])->name('tanding.store');
Route::get('/tanding/{id}/edit', [TandingController::class, 'edit'])->name('tanding.edit');
Route::put('/tanding/{id}', [TandingController::class, 'update'])->name('tanding.update');
Route::delete('/tanding/{tanding}', [TandingController::class, 'destroy'])->name('tanding.destroy');
Route::get('/list_tanding', [TandingController::class, 'index'])->name('tanding.index');
// putri

// klasemen putri
Route::get('/tim', [TimController::class, 'index'])->name('tim.index');
// end klasemen putri

Auth::routes();
