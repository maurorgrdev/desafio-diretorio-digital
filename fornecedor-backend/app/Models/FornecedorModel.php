<?php

namespace App\Models;

use Database\Factories\FornecedorFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class FornecedorModel extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fornecedores';

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'nome_empresa' => '',
        'cnpj' => '',
        'email'=> '',
        'cep'=> '',
        'endereco'=> '',
        'numero'=> '',
        'complemento'=> '',
        'bairro'=> '',
        'cidade'=> '',
        'estado'=> '',
        'telefone'=> '',
        'atuacao'=> '',
        'descricao'=> '',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome_empresa', 
        'cnpj',
        'email',
        'cep',
        'endereco',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'telefone',
        'atuacao',
        'descricao'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}
