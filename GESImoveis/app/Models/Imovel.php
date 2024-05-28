<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imovel extends Model
{
    use HasFactory;

    protected $table = 'imovel';

    protected $fillable = [
        'id_tipo_imovel',
        'id_user',
        'area',
        'morada',
        'andar',
        'num_divisoes',
        'ano_construcao',
        'val_seguro',
        'val_imi',
        'val_condominio',
        'data_aquisicao',
        'preco_compra'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function tipo_imovel()
    {
        return $this->belongsTo(TipoImovel::class, 'id_tipo_imovel');
    }
}
