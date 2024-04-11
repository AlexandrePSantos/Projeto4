<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $fillable = ['id_imovel', 'foto'];

    public function imovel()
    {
        return $this->belongsTo(Imovel::class, 'id_imovel');
    }
}
