<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoImovel extends Model
{
    use HasFactory;

    protected $fillable = ['descricao'];

    public function imoveis()
    {
        return $this->hasMany(Imovel::class, 'id_tipo_imovel');
    }
}
