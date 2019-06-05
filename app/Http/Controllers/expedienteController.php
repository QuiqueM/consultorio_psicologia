<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sitiocentral;
use Auth;
use DB;
class expedienteController extends Controller
{
    public function index(){
        $sc= new sitiocentral();
        $sc->setConnection('sitiocentral');//coneccion al sitiocentral
        $sc = sitiocentral::where('tabla','=','paciente')->first();//obetener nombres de los fragmentos
        /*$clase = 'App'. $sc->nombre;
        $sitio = new $clase();
        $sitio->setConnection('sitio'.$sc->sitio);
        $pacientes = $sitio::where('id_psicologo','=',Auth::user()->id)->get(); */
        $pacientes = DB::connection('sitio'.$sc->sitio)->table($sc->nombre)
        ->where('id_psicologo','=', Auth::user()->id)
        ->get();
        return view('expedientes')->with('paciente',$pacientes);
    }

    public function store(Request $request){
        $sc= new sitiocentral();
        $sc->setConnection('sitiocentral');//coneccion al sitiocentral
        $sc = sitiocentral::where('tabla','=','expediente')->first();//obetener nombres de los fragmentos
        if($sc != null){
            /*$clase = 'App'. $sc->nombre;
            $s1 = new $clase();
            $s1->setConnection('sitio'.$sc->sitio);
            $s1->avance = $request->input('avance');
            $s1->notas = $request->input('notas');
            $s1->situacion = $request->input('situacion');
            $s1->fecha = $request->input('fecha');
            $s1->id_paciente = $request->input('paciente');
            $s1->save();*/
            DB::connection('sitio'.$sc->sitio)->table($sc->nombre)
                ->insert([
                    'avance' => $request->avance,
                    'notas' => $request->notas,
                    'situacion' => $request->situacion,
                    'fecha' => $request->fecha,
                    'id_paciente' => $request->paciente,
                ]);
            return back()->with('msjaddexpe','correcto');
        } else {
            return back()->with('msjaddexpefail','correcto');
        }
        
    }
}
