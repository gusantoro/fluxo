<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Lancamento;

class Tipo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tipos';
    protected $primaryKey = 'id_tipo';
    protected $date = [
        'create_at',
        'update_at',
        'delet_at'
    ];

    protected $fillable = [
        'tipo'
    ];

    /**
     * -------------------------------------
     * | Relacionamentos
     * |
     * -------------------------------------
     */

     public function lancamentos(){
        return $this->belongsTo(Lancamento::class,
        'id_tipo','id_tipo');
     }
}
