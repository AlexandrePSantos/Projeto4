<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDespesa extends Model
{
    use HasFactory;

    protected $table = 'tipo_despesa';

    public $timestamps = false;

    protected $fillable = ['tipo'];

    public function despesas()
    {
        return $this->hasMany(Despesa::class, 'id_tipo_despesa');
    }
}
