<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    use HasFactory;

    protected $table = 'contrato';

    protected $fillable = [
        'id_contrato',
        'id_user',
        'data_pag',
        'valor',
        'estado'
    ];

    public function contrato()
    {
        return $this->belongsTo(Contrato::class, 'id_contrato');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
