<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Models\Book;
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
})->name('login.show')->middleware('guest');

Route::get('/signup',function(){
    return view('signup');
})->middleware('guest');

Route::middleware('role:admin,user')->group(function () {

});
Route::middleware('role:admin')->group(function () {
    Route::get('/admin',[AdminController::class,'index'])->name('admin');
});
Route::middleware('role:user')->group(function () {
    Route::get('/profile', function(){
        return view('profile');
    })->name('profile');
}); 

Route::middleware('auth')->group(function(){
   
  
    // Route::get('/user', [LoginController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/user', function(){
       
    $buku = session('buku'); // Mengambil data buku yang dikirim
        $buku = Book::all();
        return view('user', ['buku'=> $buku]);
    })->name('user');
Route::post('/logout',[LoginController::class,'logout'])->name('logout');   

Route::post('/',[LoginController::class,'auth'])->name('login');
Route::post('/signup',[LoginController::class,'create'])->name('signup'); 
Route::get('/buku/{id}',[BukuController::class,'tampil'])->name('detail.buku');  
Route::get('/edit/buku/{id}',[BukuController::class,'edit'])->name('edit.buku');  
Route::get('/add/buku/',[AdminController::class,'add'])->name('add.buku');  
Route::post('/add/buku/',[AdminController::class,'insert'])->name('insert.buku');  
Route::delete('/delete/buku/{id}',[BukuController::class,'delete'])->name('delete.buku');  


