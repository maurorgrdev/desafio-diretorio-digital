<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Http\Resources\FornecedorResource;
use App\Models\ArquivoFornecedor;
use App\Models\FornecedorModel;
use App\Models\User;
use App\Notifications\EdicaoUsuarioNotificacao;
use App\Notifications\NovoUsuarioNotificacao;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FornecedorController extends Controller
{
    public function store(Request $request){
        try {
            $data = $request->all();

            $fornecedor = FornecedorModel::create($data);
            $senha = bin2hex(random_bytes(3));
            $user = User::create([
                'name' => $fornecedor->nome_empresa,
                'email' => $fornecedor->email,
                'password' => bcrypt($senha),
            ]);

            $user->notify(new NovoUsuarioNotificacao($fornecedor->email, $senha));

            return response()->json([
                "message" => "Fornecedor criado com sucesso!",
                "success" => true
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ]);
        }
    }

    public function update(Request $request, $id){
        $data = $request->all();

        if(FornecedorModel::where('id', $id)->exists()){
            $fornecedor = FornecedorModel::findOrFail($id);
            $fornecedor->update($data);
            
            // $user->notify(new EdicaoUsuarioNotificacao($data['email'], 'senha'));

            return response()->json([
                "message" => "Fornecedor atualizado",
                "success" => true,
            ], 200);
        } else {
            return response()->json([
                "message" => "Fornecedor não encontrado!",
                "success" => false,
              ]);
        }
    }

    public function index(){
        $fornecedores = FornecedorModel::all();

        return response()->json(FornecedorResource::collection($fornecedores), 200);
    }

    public function show($id){
        if (FornecedorModel::where('id', $id)->exists()) {
            $fornecedor = FornecedorModel::findOrFail($id);
            return response(new FornecedorResource($fornecedor), 200);
        } else {
            return response()->json([
              "message" => "Fornecedor não encontrado!"
            ], 404);
        }
    }

    public function destroy($id){
        if(FornecedorModel::where('id', $id)->exists()) {
            $fornecedor = FornecedorModel::findOrFail($id);
            $user = User::where('email', $fornecedor->email)->first();
            
            $user->delete();
            $fornecedor->delete();
    
            return response()->json([
              "message" => "Fornecedor deletado"
            ], 202);
        } else {
            return response()->json([
              "message" => "Fornecedor não encontrado"
            ], 404);
        }
    }

    public function vincularArquivoFornecedor(Request $request){
        $upload = new ArquivoFornecedor();

        $upload->fornecedor_id = $request->fornecedor_id; 
        $upload->name = $request->name;
        $upload->path = 'fornecedor/'. $request->fornecedor_id. '/'.$request->name.
        
        $upload->save();

        return response()->json('tudo certo ne pae!');
    }

    public function uploadArquivo(Request $request){
        $fornecedor = FornecedorModel::where('email', $request->fornecedor_email)->first();

        $check_file_exist = ArquivoFornecedor::where('fornecedor_id', $fornecedor->id)->exists();
        
        // $check_file_exist = Storage::disk('local')->exists($fornecedor->path. '/'. $fornecedor->id. '/'. $fornecedor->filename);

        if(!$check_file_exist){

            $path_final = Storage::disk('local')->put('fornecedor/' . $fornecedor->id , $request->file('file'));
            
            $array_name_file = explode("/", $path_final);

            $upload = new ArquivoFornecedor();

            $upload->fornecedor_id = $fornecedor->id; 
            $upload->name = $request->name;
            $upload->filename = $array_name_file[(count($array_name_file) - 1)];
            $upload->path = 'fornecedor';
            
            $upload->save();

            return response()->json([
                'message' => 'Upload feito com sucesso',
                'success' => true
            ], 200);
        } else {
            return response()->json([
                'message' => 'Arquivo já existente',
                'success' => false

            ], 200);
        }
    }

    public function downloadArquivo($id){
        $arquivo = ArquivoFornecedor::where('fornecedor_id', $id)->first();
        
        $arquivo = Storage::path($arquivo->path. '/'. $id. '/'. $arquivo->filename);

        return response()->file($arquivo);
    }

    public function deleteArquivo($id){
        $arquivo = ArquivoFornecedor::where('fornecedor_id', $id)->first();

        Storage::delete($arquivo->path. '/'. $arquivo->fornecedor_id. '/'. $arquivo->filename);
        $arquivo->delete();

        return response()->json(['message' => 'Arquivo deletado'], 200);
    }
}
