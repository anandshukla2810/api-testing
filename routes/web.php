<?php

use Illuminate\Support\Facades\Route;

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
    return view('index');
});
Route::get('/authors', function () {
    return view('list-authors');
});
Route::get('/authors/{id}', function () {
    return view('single-author');
});
Route::get('/profile', function () {
    return view('profile');
});
Route::get('/add-book', function () {
    return view('add-book');
});
