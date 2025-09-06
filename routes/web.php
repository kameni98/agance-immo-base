<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('properties')->name('properties.')->group(function () {
    Route::get('index', [\App\Http\Controllers\PropertiesController::class, 'index'])->name('index');
    Route::get('/{slug}-{property}/show', [\App\Http\Controllers\PropertiesController::class, 'show'])->name('show')
    ->where(['property' => '[0-9]+','slug' => '[a-z0-9-]+']);
    Route::post('/{property}/contact', [\App\Http\Controllers\PropertiesController::class, 'contact'])->name('contact')
    ->where(['property' => '[0-9]+']);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('cities', \App\Http\Controllers\Admin\CitiesController::class)->except(['show']); //ici on spécifie qu'on veut toutes les methodes sauf la methode show
    Route::resource('properties', \App\Http\Controllers\Admin\PropertiesController::class)->except(['show']); //ici on spécifie qu'on veut toutes les methodes sauf la methode show
    Route::resource('options', \App\Http\Controllers\Admin\OptionsController::class)->except(['show']); //ici on spécifie qu'on veut toutes les methodes sauf la methode show
});




require __DIR__.'/auth.php';
