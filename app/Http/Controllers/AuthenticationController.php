<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;
use App\User;

class AuthenticationController extends Controller
{
    public function login(Request $request) {

        $messages = [
            'required' => 'O campo :attribute e obrigatorio.',
        ];

        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'email' => 'required'
        ], $messages);
        
        if ($validator->fails()) {
            return $validator->errors();
        }

        extract($request->all());

        $user = User::where('email', $email)->first();

        $checked = password_verify($password, $user->password);
        if ($login_with_facebook) {
            //composer require laravel/socialite
            //futuramente implementar authenticação com o pacote socialite
            $user = User::find(1)->first();
            $user->persona;
            return $user;
        } else if ($login_with_google) {
            //composer require laravel/socialite
            //futuramente implementar authenticação com o pacote socialite
            $user = User::find(1)->first();
            $user->persona;
            return $user;
        }

        if ($checked) {
            $user->persona;
            return $user;
        } else {
            return 'Senha incorreta';
        }
        return "alguma coisa deu muito errado"; 
    }

    public function register(Request $request) {
        
        $messages = [
            'required' => 'O campo :attribute e obrigatorio.',    
            'unique' => ':attribute já cadastrado.',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required',
            'email' => 'required|unique:users'
        ], $messages);
        
        if ($validator->fails()) {
            return $validator->errors();
        }
        
        extract($request->all());

        if ($register_with_facebook && false) {
            //composer require laravel/socialite
            //futuramente implementar authenticação com o pacote socialite
        } else if ($register_with_google && false) {
            //composer require laravel/socialite
            //futuramente implementar authenticação com o pacote socialite
        } else {
            $user = new User();
            $user->email = $email;
            $user->password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);
            $user->persona_id = $persona_id;
            $user->name = $name;
            $user->save();
            $user->persona;
        }

        return $user;
    }

    public function logout(Request $request) {
        
        return true;
    }

}
