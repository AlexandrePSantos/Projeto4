<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Despesa extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_imovel',
        'id_user',
        'id_tipo_despesa',
        'data',
        'valor'
    ];

    public function imovel()
    {
        return $this->belongsTo(Imovel::class, 'id_imovel');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function tipoDespesa()
    {
        return $this->belongsTo(TipoDespesa::class, 'id_tipo_despesa');
    }
}
