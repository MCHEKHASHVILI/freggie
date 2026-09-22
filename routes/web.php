<?php

use App\Http\Controllers\Admin\LocaleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')
    ->get('/admin/locale/{locale}', [LocaleController::class, 'update'])
    ->name('admin.locale.update');
