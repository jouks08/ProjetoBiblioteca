@extends('layouts.main_layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col">

            @include('top_bar')

            @if(count($livros ?? []) === 0)
            <div class="row mt-5">
                <div class="col text-center">
                    <p class="display-6 mb-5 text-secondary opacity-50">Você não tem livros cadastrados!</p>
                    <a href="{{ route('newLivro') }}" class="btn btn-secondary btn-lg p-3 px-5">
                        <i class="fa-solid fa-book-open me-3"></i>Cadastre seu primeiro Livro
                    </a>
                </div>
            </div>

            @else
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('newLivro') }}" class="btn btn-secondary px-3">
                    <i class="fa-solid fa-plus me-2"></i>Novo Livro
                </a>
                <a href="{{ route('autores_index') }}" class="btn btn-outline-info px-3 ms-2">
                    <i class="fa-solid fa-users me-2"></i>Gerenciar Autores
                </a>
            </div>

            @foreach($livros as $livro)
            <div class="card mb-3 shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <!-- Título do Livro -->
                        <h5 class="card-title text-primary fw-bold mb-1">
                            {{ $livro->titulo }}
                        </h5>

                        <!-- Demais atributos -->
                        <p class="card-text text-muted mb-0">
                            Autor: <strong>{{ $livro->autor->nome }}</strong> |
                            Publicação: {{ \Carbon\Carbon::parse($livro->data_publicacao)->format('d/m/Y') }} |
                            Páginas: {{ $livro->paginas }}
                        </p>
                    </div>

                    <!-- Botões de Ação (Editar / Excluir) -->
                    <div>
                        <a href="{{ route('edit.livro', ['id' => \App\Services\Operations::encryptId($livro->id)]) }}" class="btn btn-outline-primary btn-sm me-1">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                        <a href="{{ route('delete.livro', ['id' => \App\Services\Operations::encryptId($livro->id)]) }}" class="btn btn-outline-danger btn-sm">
                            <i class="fa-regular fa-trash-can"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach

            @endif

        </div>
    </div>
</div>
@endsection