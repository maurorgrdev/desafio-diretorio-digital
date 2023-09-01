<?php

namespace App\Http\Resources;

use App\Models\ArquivoFornecedor;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FornecedorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $arquivo = ArquivoFornecedor::where('fornecedor_id', $this->id)->first();

        return [
            'codigo' => $this->id,
            'empresa'=> strtoupper($this->nome_empresa),
            'cnpj'=> $this->cnpj,
            'email' => $this->email,
            'cep' => $this->cep,
            'endereco' => $this->endereco,
            'numero' => $this->numero,
            'complemento' => $this->complemento,
            'bairro' => $this->bairro,
            'cidade' => $this->cidade,
            'estado' => $this->estado,
            'telefone' => $this->telefone,
            'atuacao' => $this->atuacao,
            'descricao' => $this->descricao,
            'arquivo_id' => $arquivo ? $arquivo->id : '',
            'arquivo_filename' => $arquivo ? $arquivo->name : '',
        ];
    }
}
