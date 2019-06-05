<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sitiocentral;
use Auth;
use DB;

class vistaExp extends Controller
{
    public function index(Request $request){
        $sc= new sitiocentral();
        $sc->setConnection('sitiocentral');//coneccion al sitiocentral
        $sc = sitiocentral::where('tabla','=','expediente')->first();//obetener nombres de los fragmentos
        /*$clase = 'App'. $sc->nombre;
        $sitio = new $clase();
        $sitio->setConnection('sitio'.$sc->sitio);
        $expediente = $sitio::where('id_paciente','=',$request->idpa)->orderby('id','desc')->get();*/
        $expediente = DB::connection('sitio'.$sc->sitio)->table($sc->nombre)
            ->where('id_paciente','=',$request->idpa)
            ->orderBy('id','desc')
            ->get();
        $sc= new sitiocentral();
        $sc->setConnection('sitiocentral');//coneccion al sitiocentral
        $sc = sitiocentral::where('tabla','=','paciente')->first();//obetener nombres de los fragmentos
        /*$clase = 'App'. $sc->nombre;
        $sitio = new $clase();
        $sitio->setConnection('sitio'.$sc->sitio);
        $pacientes = $sitio::where('id_psicologo','=',Auth::user()->id)->get();*/
        $pacientes = DB::connection('sitio'.$sc->sitio)->table($sc->nombre)
            ->where('id_psicologo','=',Auth::user()->id)
            ->get();
        $activo = null;
        return view('verExpediente')->with('expediente',$expediente)->with('activo',$activo)->with('pacientes',$pacientes);
    }
    public function buscar(Request $request){
        $sc= new sitiocentral();
        $sc->setConnection('sitiocentral');//coneccion al sitiocentral
        $sc = sitiocentral::where('tabla','=','expediente')->first();//obetener nombres de los fragmentos
        /*$clase = 'App'. $sc->nombre;
        $sitio = new $clase();
        $sitio->setConnection('sitio'.$sc->sitio);
        $activo = $sitio::where('id','=',$request->idExp)->first();*/
        $activo = DB::connection('sitio'.$sc->sitio)->table($sc->nombre)
            ->where('id','=',$request->idExp)
            ->first();
        return redirect('expediente/ver')->with('activo',$activo);
    }
}
