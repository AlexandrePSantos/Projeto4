<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDespesa extends Model
{
    use HasFactory;

    protected $fillable = ['descricao'];

    public function despesas()
    {
        return $this->hasMany(Despesa::class, 'id_tipo_despesa');
    }
}
