<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro; 
use App\Models\User;

class MainController extends Controller
{
    public function index()
    {

        $livros = User::find(session('user')['id'])->livros;

        return view('home', compact('livros'));
    }
}