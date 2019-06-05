<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sitiocentral;
use Auth;
use DB;
class buscarController extends Controller
{
    public function index(Request $request){
        $sc= new sitiocentral();
        $sc->setConnection('sitiocentral');//coneccion al sitiocentral
        $sc = sitiocentral::where('tabla','=','expediente')->first();//obetener nombres de los fragmentos
        /*$clase = 'App'. $sc->nombre;
        $sitio = new $clase();
        $sitio->setConnection('sitio'.$sc->sitio);*/
        $activo = DB::connection('sitio'.$sc->sitio)->table($sc->nombre)
                ->where('id','=',$request->input('idExp'))
                ->first();
        //$activo = $sitio::where('id','=',$request->idExp)->first();
        $sc= new sitiocentral();
        $sc->setConnection('sitiocentral');//coneccion al sitiocentral
        $sc = sitiocentral::where('tabla','=','expediente')->first();//obetener nombres de los fragmentos
        /*$clase = 'App'. $sc->nombre;
        $sitio = new $clase();
        $sitio->setConnection('sitio'.$sc->sitio);*/
        $expediente = DB::connection('sitio'.$sc->sitio)->table($sc->nombre)
                ->where('id_paciente','=',$activo->id_paciente)
                ->orderBy('id','desc')
                ->get();
        //$expediente = $sitio::where('id_paciente','=',$activo->id_paciente)->orderby('id','desc')->get();
        $sc= new sitiocentral();
        $sc->setConnection('sitiocentral');//coneccion al sitiocentral
        $sc = sitiocentral::where('tabla','=','paciente')->first();//obetener nombres de los fragmentos
        /*$clase = 'App'. $sc->nombre;
        $sitio = new $clase();
        $sitio->setConnection('sitio'.$sc->sitio);*/
        $pacientes = DB::connection('sitio'.$sc->sitio)->table($sc->nombre)
            ->where('id_psicologo','=',Auth::user()->id)
            ->get();
        //$pacientes = $sitio::where('id_psicologo','=',Auth::user()->id)->get();
        
        return view('verExpediente')->with('expediente',$expediente)->with('activo',$activo)->with('pacientes',$pacientes);
    }
}
