@extends('layouts.main_layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col">

            @include('top_bar')

            <div class="row">
                <div class="col">
                    <p class="display-6 mb-0">EDITAR LIVRO</p>
                </div>
                <div class="col text-end">
                    <a href="{{ route('home') }}" class="btn btn-outline-danger">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                </div>
            </div>

            <form action="{{ route('edit.livro.submit') }}" method="post">
                @csrf
                <input type="hidden" name="livro_id" value="{{ \App\Services\Operations::encryptId($livro->id) }}">
                
                <div class="row mt-3">
                    <div class="col">
                        
                        <div class="mb-3">
                            <label class="form-label">Nome do Livro</label>
                            <input type="text" class="form-control bg-primary text-white" name="titulo" value="{{ old('titulo', $livro->titulo) }}">
                            @error('titulo')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Autor</label>
                            <select class="form-control bg-primary text-white" name="autor_id">
                                <option value="">Selecione um autor...</option>
                                @foreach($autores as $autor)
                                    <option value="{{ $autor->id }}" {{ old('autor_id', $livro->autor_id) == $autor->id ? 'selected' : '' }}>
                                        {{ $autor->nome }}
                                    </option>
                                @endforeach
                            </select>
                            @error('autor_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Gênero</label>
                                <input type="text" class="form-control bg-primary text-white" name="genero" value="{{ old('genero', $livro->genero) }}">
                                @error('genero')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Número de Páginas</label>
                                <input type="number" class="form-control bg-primary text-white" name="numero_paginas" value="{{ old('numero_paginas', $livro->numero_paginas) }}">
                                @error('numero_paginas')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Edição</label>
                                <input type="text" class="form-control bg-primary text-white" name="edicao" value="{{ old('edicao', $livro->edicao) }}">
                                @error('edicao')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Data de Publicação</label>
                                <input type="date" class="form-control bg-primary text-white" name="data_publicacao" value="{{ old('data_publicacao', $livro->data_publicacao) }}">
                                @error('data_publicacao')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col text-end">
                        <a href="{{ route('home') }}" class="btn btn-primary px-5"><i class="fa-solid fa-ban me-2"></i>Cancelar</a>
                        <button type="submit" class="btn btn-secondary px-5"><i class="fa-regular fa-circle-check me-2"></i>Salvar</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection