<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    protected $table = 'contrato';

    protected $fillable = [
        'id_inquilino',
        'id_imovel',
        'id_tipo_contrato',
        'id_user',
        'data_ini',
        'data_fim',
        'valor',
        'perocidade_pag',
        'estado',
        'data_termino',
        'valor_pago'
    ];

    public function inquilino()
    {
        return $this->belongsTo(Inquilino::class, 'id_inquilino');
    }

    public function imovel()
    {
        return $this->belongsTo(Imovel::class, 'id_imovel');
    }

    public function tipoContrato()
    {
        return $this->belongsTo(TipoContrato::class, 'id_tipo_contrato');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
