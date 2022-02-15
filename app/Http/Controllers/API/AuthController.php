<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\Models\User;

class AuthController extends Controller
{
    //função de registro
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);
        //se os dados nao forem validados, ira retornar json com erro
        if($validator->fails()){
            return response()->json([$validator->errors()], 401);       
        }
        //caso os dados forem validados, serão armazenados na tabela de users
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
         ]);
        
        //criando novo token 
        $token = $user->createToken('auth_token')->plainTextToken;
        //retornando json com os detalhes que foram cadastrados junto com o token
        return response()
            ->json(['data' => $user,'access_token' => $token, 'token_type' => 'Bearer', ]);
    }
    //função de login
    public function login(Request $request)
    {
        //caso os dados nao correspondam ao da tabela, retorna json com unauthorized
        if (!Auth::attempt($request->only('email', 'password')))
        {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }
        //caso os dados sejam verdadeiros, ira criar um novo token para esse user
        $user = User::where('email', $request['email'])->firstOrFail();
        //criando token
        $token = $user->createToken('auth_token')->plainTextToken;
        //retornando json com login autorizado
        return response()
            ->json(['message' => 'Hi '.$user->name.', welcome to home','access_token' => $token, 'token_type' => 'Bearer', ]);
    }

    //função para logout
    public function logout()
    {
        //deletando token na tabela de token da sessao logada
        auth()->user()->tokens()->delete();
        //retornando mensagem de logout realizado
        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }
}