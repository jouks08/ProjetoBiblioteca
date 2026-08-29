<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Livro;
use App\Models\Autor;
use App\Services\Operations;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    public function index()
    {
        $livros = Livro::with('autor')
            ->where('user_id', session('id')) 
            ->get();

        return view('home', ['livros' => $livros]);
    }

    public function newLivro()
    {
        $autores = Autor::all();
        return view('livros.new_livro', ['autores' => $autores]);
    }

    public function newLivroSubmit(Request $request)
    {
        $request->validate([
            'titulo'          => 'required|min:2|max:150',
            'genero'          => 'nullable|max:50',
            'numero_paginas'  => 'nullable|integer',
            'autor_id'        => 'required|exists:autores,id',
            'data_publicacao' => 'required|date',
        ]);

        $livro = new Livro();
        $livro->user_id = session('user.id'); 
        $livro->titulo = $request->titulo;
        $livro->genero = $request->genero;
        $livro->numero_paginas = $request->numero_paginas;
        $livro->autor_id = $request->autor_id; 
        $livro->data_publicacao = $request->data_publicacao;
        $livro->save();

        return redirect()->route('home');
    }

    public function editLivro($id)
    {
        $decrypted_id = Operations::decryptId($id);
        
        if ($decrypted_id instanceof \Illuminate\Http\RedirectResponse) {
            return $decrypted_id;
        }

        $livro = Livro::where('user_id', session('user.id'))->find($decrypted_id);
        
        if (!$livro) {
            return redirect()->route('home');
        }

        $autores = Autor::all();
        return view('livros.edit_livro', [
            'livro' => $livro, 
            'autores' => $autores
        ]);
    }

    public function editLivroSubmit(Request $request)
    {
        if ($request->livro_id === null) {
            return redirect()->route('home');
        }

        $request->validate([
            'titulo'          => 'required|min:2|max:150',
            'genero'          => 'nullable|max:50',
            'numero_paginas'  => 'nullable|integer',
            'autor_id'        => 'required|exists:autores,id',
            'data_publicacao' => 'required|date',
        ]);

        $decrypted_id = Operations::decryptId($request->livro_id);
        
        if ($decrypted_id instanceof \Illuminate\Http\RedirectResponse) {
            return $decrypted_id;
        }

        $livro = Livro::where('user_id', session('user.id'))->find($decrypted_id);
        
        if (!$livro) {
            return redirect()->route('home');
        }

        $livro->titulo = $request->titulo;
        $livro->genero = $request->genero;
        $livro->numero_paginas = $request->numero_paginas;
        $livro->autor_id = $request->autor_id;
        $livro->data_publicacao = $request->data_publicacao;
        $livro->save();

        return redirect()->route('home');
    }

    public function deleteLivro($id)
    {
        $decrypted_id = Operations::decryptId($id);
        
        if ($decrypted_id instanceof \Illuminate\Http\RedirectResponse) {
            return $decrypted_id;
        }

        $livro = Livro::where('user_id', session('user.id'))->find($decrypted_id);
        
        if (!$livro) {
            return redirect()->route('home');
        }

        return view('livros.delete_livro', ['livro' => $livro]);
    }

    public function deleteLivroConfirm($id)
    {
        $decrypted_id = Operations::decryptId($id);
        
        if ($decrypted_id instanceof \Illuminate\Http\RedirectResponse) {
            return $decrypted_id;
        }

        $livro = Livro::where('user_id', session('user.id'))->find($decrypted_id);
        
        if (!$livro) {
            return redirect()->route('home');
        }
        
        $livro->delete();
        return redirect()->route('home');
    }
}