<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquilino extends Model
{
    use HasFactory;

    protected $table = 'inquilino';

    protected $fillable = [
        'id_user',
        'nome',
        'apelido',
        'email',
        'telemovel',
        'telefone',
        'morada',
        'codigo_postal',
        'nif',
    ];
}
