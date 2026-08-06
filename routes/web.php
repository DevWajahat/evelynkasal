<?php

use App\Http\Controllers\Web\AboutController;
use App\Http\Controllers\Web\BookController;
use App\Http\Controllers\Web\ContactController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\HomeController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('about', [AboutController::class, 'index'])->name('about');

Route::get('contact', [ContactController::class, 'index'])->name('contact');


Route::get('book', [BookController::class, 'index'])->name('book');
