<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'genero',
        'numero_paginas',
        'autor',
        'edicao',
    ];


    public function autor()
    {
        return $this->belongsTo(Autor::class);
    }
}
