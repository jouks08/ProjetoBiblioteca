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

            @foreach ($livros as $livro)
            <div class="card p-4 mb-3 shadow-sm">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="text-info mb-1">{{ $livro->nome }}</h4>
                        <small class="text-secondary">
                            Autor: <strong>{{ $livro->autor->nome ?? 'Desconhecido' }}</strong> 
                            | Publicação: {{ $livro->data_publicacao ? date('d/m/Y', strtotime($livro->data_publicacao)) : 'Não informada' }} 
                            | Páginas: {{ $livro->numero_paginas ?? 'N/A' }}
                        </small>
                    </div>
                    <div class="col-auto text-end">
                        @php
                            $encryptedId = \App\Services\Operations::encryptId($livro->id);
                        @endphp
                        
                        <a href="{{ route('edit.livro', ['id' => $encryptedId]) }}" class="btn btn-outline-secondary btn-sm mx-1">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                        <a href="{{ route('delete.livro', ['id' => $encryptedId]) }}" class="btn btn-outline-danger btn-sm mx-1">
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