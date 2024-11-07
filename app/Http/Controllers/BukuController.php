<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function tampil($id){
       $buku =  Book::findOrFail($id);
   
       return view('detailBuku',[
        'buku'=> $buku
       ]);
    }
}
