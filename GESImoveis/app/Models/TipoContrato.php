<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoContrato extends Model
{
    use HasFactory;

    protected $table = 'tipo_contrato';

    public $timestamps = false;

    protected $fillable = ['tipo'];

    public function contratos()
    {
        return $this->hasMany(Contrato::class, 'id_tipo_contrato');
    }
}
