<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\requestRegistro;
use App\User;
use DB;//base de datos

class registroController extends Controller
{
    public function index(){
        return view('auth.registro');
    }
    public function store(requestRegistro $request){
         /*Crear un nuevo usuario de tipo paciente */
         User::create([
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'rol'=>'paciente'
        ]);

        return redirect('/login');
    }
}
