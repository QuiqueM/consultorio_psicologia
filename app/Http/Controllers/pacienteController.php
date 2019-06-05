<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\sitiocentral;
use DB;


class pacienteController extends Controller
{
    public function index(){
        $user=Auth::user();
        $sc= new sitiocentral();
        $sc->setConnection('sitiocentral');
        $sc = sitiocentral::where('tabla','=','paciente')->first();
        /*$clase = 'App'. $sc->nombre;
        $s2 = new $clase();
        $s2->setConnection('sitio'.$sc->sitio);
        $usuario = $s2::where('id','=',$user->id)->first();*/
        $usuario = DB::connection('sitio'.$sc->sitio)->table($sc->nombre)
            ->where('id','=',$user->id)
            ->first();
        if($user != null){
            return view('perfilpaciente',compact('usuario'));
        }
        else{
            return view('perfilpaciente',compact('usuario'));
        }
        
    }

    public function store(Request $request){
        //guardamos los datos del paciente
        $user=Auth::user();
        $sc= new sitiocentral();
        $sc->setConnection('sitiocentral');
        $sc = sitiocentral::where('tabla','=','paciente')->first();
        /*$clase = 'App'. $sc->nombre;
        $s2 = new $clase();
        $s2->setConnection('sitio'.$sc->sitio);
        $s2->id =$user->id;
        $s2->nombre = $request->input('nombre');
        $s2->a_paterno = $request->input('ap1');
        $s2->a_materno = $request->input('ap2');
        $s2->calle = $request->input('calle');
        $s2->numero = $request->input('numero');
        $s2->colonia = $request->input('colonia');
        $s2->edad = $request->input('edad');
        $s2->telefono = $request->input('telefono');
        $s2->telefono_contacto = $request->input('telefono_contacto');
        $s2->id_psicologo = -1;
        $s2->save();*/
        DB::connection('sitio'.$sc->sitio)->table($sc->nombre)
        ->insert([
            'id' => $user->id,
            'nombre' => $request->nombre,
            'a_paterno' => $request->ap1,
            'a_materno' => $request->ap2,
            'calle' => $request->calle,
            'numero' => $request->numero,
            'colonia' => $request->colonia,
            'edad' => $request->edad,
            'telefono' => $request->telefono,
            'telefono_contacto' => $request->telefono_contacto,
            'id_psicologo' => -1
        ]);

        return back()->with('msj','Datos actualizados correctamente');

    }
    public function update(Request $request){
        $user=Auth::user();
        $sc= new sitiocentral();
        $sc->setConnection('sitiocentral');
        $sc = sitiocentral::where('tabla','=','paciente')->first();
        /*$clase = 'App'. $sc->nombre;
        $s2 = new $clase();
        $s2->setConnection('sitio'.$sc->sitio);
        $us = $s2::where('id','=',$user->id)->first();
        $us->id =$user->id;
        $us->nombre = $request->input('nombre');
        $us->a_paterno = $request->input('ap1');
        $us->a_materno = $request->input('ap2');
        $us->calle = $request->input('calle');
        $us->numero = $request->input('numero');
        $us->colonia = $request->input('colonia');
        $us->edad = $request->input('edad');
        $us->telefono = $request->input('telefono');
        $us->telefono_contacto = $request->input('telefono_contacto');
        $us->id_psicologo = $request->input('id_psico');
        $us->save();*/
        DB::connection('sitio'.$sc->sitio)->table($sc->nombre)
        ->insert([
            'id' => $user->id,
            'nombre' => $request->nombre,
            'a_paterno' => $request->ap1,
            'a_materno' => $request->ap2,
            'calle' => $request->calle,
            'numero' => $request->numero,
            'colonia' => $request->colonia,
            'edad' => $request->edad,
            'telefono' => $request->telefono,
            'telefono_contacto' => $request->telefono_contacto,
            'id_psicologo' => -1
        ]);
        return back()->with('msj','Datos actualizados correctamente');
    }
    
}
