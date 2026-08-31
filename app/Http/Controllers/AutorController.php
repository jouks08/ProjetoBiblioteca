<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Autor;
use App\Services\Operations;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    public function index()
    {
        $autores = Autor::all();

        return view('autores.autores_index', ['autores' => $autores]);

    }

    public function newAutor()
    {
        return view('autores.new_autor');
    }

    public function newAutorSubmit(Request $request)
    {
        $request->validate([
            'nome'            => 'required|min:3|max:100',
            'genero'          => 'nullable|max:50',
            'nacionalidade'   => 'nullable|max:50',
            'data_nascimento' => 'nullable|date',
        ]);

        $autor = new Autor();
        $autor->nome = $request->nome;
        $autor->genero = $request->genero;
        $autor->nacionalidade = $request->nacionalidade;
        $autor->data_nascimento = $request->data_nascimento;
        $autor->save();

        return redirect()->route('home');
    }

    public function editAutor($id)
    {
        $decrypted_id = Operations::decryptId($id);
        
        if ($decrypted_id instanceof \Illuminate\Http\RedirectResponse) {
            return $decrypted_id;
        }

        $autor = Autor::find($decrypted_id);
        
        if (!$autor) {
            return redirect()->route('autores_index');
        }

        return view('autores.edit_autor', ['autor' => $autor]);
    }

    public function editAutorSubmit(Request $request)
    {
        if ($request->autor_id === null) {
            return redirect()->route('autores_index');
        }

        $request->validate([
            'nome'            => 'required|min:3|max:100',
            'genero'          => 'nullable|max:50',
            'nacionalidade'   => 'nullable|max:50',
            'data_nascimento' => 'nullable|date',
        ]);

        $decrypted_id = Operations::decryptId($request->autor_id);
        
        if ($decrypted_id instanceof \Illuminate\Http\RedirectResponse) {
            return $decrypted_id;
        }

        $autor = Autor::find($decrypted_id);
        
        if (!$autor) {
            return redirect()->route('autores_index');
        }

        $autor->nome = $request->nome;
        $autor->genero = $request->genero;
        $autor->nacionalidade = $request->nacionalidade;
        $autor->data_nascimento = $request->data_nascimento;
        $autor->save();

        return redirect()->route('autores_index');
    }

    public function deleteAutor($id)
    {
        $decrypted_id = Operations::decryptId($id);
        
        if ($decrypted_id instanceof \Illuminate\Http\RedirectResponse) {
            return $decrypted_id;
        }

        $autor = Autor::find($decrypted_id);
        
        if (!$autor) {
            return redirect()->route('autores_index');
        }

        return view('autores.delete_autor', ['autor' => $autor]);
    }

    public function deleteAutorConfirm($id)
    {
        $decrypted_id = Operations::decryptId($id);
        
        if ($decrypted_id instanceof \Illuminate\Http\RedirectResponse) {
            return $decrypted_id;
        }

        $autor = Autor::find($decrypted_id);
        
        if (!$autor) {
            return redirect()->route('autores_index');
        }
        
        $autor->delete();
        return redirect()->route('autores_index');
    }
}