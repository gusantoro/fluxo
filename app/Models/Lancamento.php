<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\{
    Tipo,
    CentroCusto,
    User
};

class Lancamento extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'lancamentos';
    protected $primaryKey = 'id_lancamento';

    protected $dates =[
        'created_at',
        'update_at',
        'deleted_at',
        'vencimento'
    ];

    protected $fillable = [
        'id_user',
        'id_tipo',
        'id_centro_custo',
        'valor',
        'vencimento',
        'descricao',
        'anexo'
    ];

    protected $casts = [
        'vencimento' => 'date',
        'valor' => 'decimal:2'
    ];

    /**
     * ------------------------------------------------
     * | RELACIONAMENTO
     * |https://laravel.com/docs/10.x/eloquent-relationships
     * ------------------------------------------------
     */
    public function tipo(){
        return $this->belongsTo(
            Tipo::class,
            'id_tipo',
            'id_tipo'
        );
    }

    public function centoCusto()
    {
        return $this->belongsTo(
            CentroCusto::class,
            'id_centro_custo',
            'id_centro_custo'
        );
    }

    public function usuario()
    {
        return $this->belongsTo(
            User::class,
            'id_user',
            'id'
        );
    }

    protected function descricao(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value),
            set: fn (string $value) => strtolower(trim($value)),
        );

    }


    /**
     * ------------------------------------------------
     * | MUTATO
     * | https://laravel.com/docs/10.x/eloquent-mutators
     * ------------------------------------------------
     */

     protected function valor(): Attribute
     {
        return Attribute::make(
            get: fn (string $value) => number_format($value,2,',','.')
        );

     }

     /**
      * -----------------------------------------------
      * |  Outros Metodos
      * |
      * -----------------------------------------------
      */
}
