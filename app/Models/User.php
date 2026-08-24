<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $fillable = [
        'username',
        'email',
        'password',
    ];


    // Dentro da classe User
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
