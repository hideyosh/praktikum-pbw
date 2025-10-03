<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/tentang-kami', function () {
    return view('about');
})->name('about');

Route::get('/kontak', function () {
    return view('kontak');
});
