<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;

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
    return view('welcome');
});



Route::get('/login', function(){
        if(Auth::check())
        {
            return redirect(route('notes'));
        }
        return view('login');
    })->name('login');

Route::post('/login', [AuthController::class,'login']);

Route::get('/logout',[AuthController::class,'logout'])->name('logout');

Route::get('/register',function (){
        if(Auth::check())
        {
            return redirect(route('notes'));
        }
        return view('register');
    })->name('register');

Route::post('/register',[AuthController::class,'register']);

Route::group(['middleware' => 'auth'], function() {
    Route::get('/notes',[NoteController::class,'index'])->name('notes');
    Route::put('/notes/{id}', [NoteController::class,'update'])->name('updateNote');
    Route::post('/notes', [NoteController::class,'create'])->name('createNote');
//    Route::get('/notes/{id}', function ($id) {
//        return 'User '.$id;
//    });
});

