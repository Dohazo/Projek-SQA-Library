<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

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
    return view('login');
})->name('login.show');
Route::get('/signup',function(){
    return view('signup');
});
Route::middleware('role:admin,user')->group(function () {

});
Route::middleware('role:admin')->group(function () {
    Route::get('/admin',function(){
        return view('admin');
    })->name('admin');
 
});
Route::middleware('role:user')->group(function () {
   
}); 

   
  
    // Route::get('/user', [LoginController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/user', function(){
       
    $buku = session('buku'); // Mengambil data buku yang dikirim
  
        return view('user', compact('buku'));
    })->name('user');
    Route::post('/logout',[LoginController::class,'logout'])->name('logout');   
   
Route::post('/',[LoginController::class,'auth'])->name('login');
Route::post('/signup',[LoginController::class,'create'])->name('signup'); 
Route::get('/buku/{id}',[BukuController::class,'tampil'])->name('detail.buku');  

