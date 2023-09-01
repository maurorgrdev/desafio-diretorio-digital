<?php

namespace App\Http\Controllers;

use App\Models\FornecedorModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        if($request['cnpj'] != ''){
            if($fornecedor = FornecedorModel::where('cnpj', $request['cnpj'])->first()){
                $request['email'] = $fornecedor->email;
            }
        }
        $credentials = $request->only(['email', 'password']);
         
        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function verifyToken(){
 
        if (Auth::check()) {
            return response()->json(['message' => 'Usuário autenticado'], 200);
        } else {
            return response()->json(['message' => 'Usuário não autorizado'], 401);
        }
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
