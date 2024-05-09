<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\HelloController;
use App\Http\Controllers\PostController;
use GuzzleHttp\Promise\Create;
use Symfony\Component\Routing\RouterInterface;

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
// Routing Bawaan Yang Pertama
Route::get('/', function () {
    return view('welcome');
});

// routing kedua 
// Route::get('hello','App\Http\Controllers\HelloController@index');
// Route::get('hello',[HelloController::class,'index']);
// Route::post('hello',[HelloController::class,'create']);
// Route::get('world',[HelloController::class,'world_message']);

// Route::resource('posts',PostController::class);
Route::get('posts',[PostController::class,'index']);
Route::get('posts/create',[PostController::class,'create']);
Route::get('posts/{id}',[PostController::class,'show']);
Route::post('posts',[PostController::class,'store']);
Route::get('posts/{id}/edit',[PostController::class,'edit']);
Route::patch('posts/{id}',[PostController::class,'update']);

// Route::get('hello',function(){
//     echo "Hello Word aku telah berhasil menggunakan laravel ";
//     $ping = ['ping' => "pong"];
//     return $ping;

//     return view('hello');
//     return view('ping');
//     });