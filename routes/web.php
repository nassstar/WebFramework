<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LevelController;

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
    //return view('welcome');
    return view('welcome');
});

Route::get('/about', function () {
    return 'NIM : 23.51.0002, NAMA : TRI BINTANG PAMUNGKAS';
});

Route::get('/hello', function () {
return 'Hello World';
});

// Route::get('/user/{name}', function ($name) {
// return 'Hallo Nama saya '.$name;
// });

Route::get('/posts/{post}/comments/{comment}', function
($postId, $commentId) {
return 'Pos ke-'.$postId." Komentar ke-: ".$commentId;
});

Route::get('/user/{name?}', function ($name=null) {
    return 'Nama saya '.$name;
});

Route::view('/Kontak', 'Kontak');

Route::get('/level', [LevelController::class, 'index']);
