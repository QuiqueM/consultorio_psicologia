<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sitiocentral;
use Auth;
use DB;

class citasController extends Controller
{
    public function index(){
        $usuario = Auth::user();//obtener datos del usuario logedo
        $sc= new sitiocentral();
        $sc->setConnection('sitiocentral');//coneccion al sitiocentral
        $sc = sitiocentral::where('tabla','=','paciente')->first();
        /*$clase = 'App'. $sc->nombre; //nombre del frgamento de la tabla paciente
        $s1 = new $clase();
        $s1->setConnection('sitio'.$sc->sitio);*/
        $paciente = DB::connection('sitio'.$sc->sitio)->table($sc->nombre)
                ->where('id','=',$usuario->id)
                ->first();
        //$paciente = $s1::where('id','=',$usuario->id)->first();//verificar si su perfil esta completo
        if($paciente == null){
            $nuevo = true;
            $psicologo = null;
        }
        else{
            if($paciente->id_psicologo == -1){
                $nuevo = true;
                $psicologo = null;
            }else{
                $nuevo = false;
                $sc= new sitiocentral();
                $sc->setConnection('sitiocentral');//coneccion al sitiocentral
                $sc = sitiocentral::where('tabla','=','psicologo')->where('sitio','=',2)->first();
                //$clase = 'App'. $sc->nombre;
                //$s1 = new $clase();
                //$s1->setConnection('sitio'.$sc->sitio);
                $psicologo = DB::connection('sitio'.$sc->sitio)->table($sc->nombre)
                    ->where('id','=',$paciente->id_psicologo)
                    ->first();
                //$psicologo = $s1::where('id','=',$paciente->id_psicologo)->first();
            } 
        }
        return view('agendarcitas')->with('nuevo',$nuevo)->with('psicologo',$psicologo);
    }
    public function store(Request $request){
        if ($request->input('hora') <= 15){
            $sc= new sitiocentral();
            $sc->setConnection('sitiocentral');//coneccion al sitiocentral
            $sc = sitiocentral::where('tabla','=','citas')->where('sitio','=',1)->first();//obetener nombres de los fragmentos
            DB::connection('sitio'.$sc->sitio)->table($sc->nombre)
                ->insert([
                    'title' => $request->title,
                    'hora'  => $request->hora,
                    'start' => $request->fecha,
                    'end'   => $request->fecha,
                    'color' => '#1e88e5',
                    'textcolor' => '#ffffff',
                    'id_psicologo' => $request->psicologo,
                    'id_paciente' => Auth::user()->id
                ]);
            
        } else {
            $sc= new sitiocentral();
            $sc->setConnection('sitiocentral');//coneccion al sitiocentral
            $sc = sitiocentral::where('tabla','=','citas')->where('sitio','=',2)->first();//obetener nombres de los fragmentos
            DB::connection('sitio'.$sc->sitio)->table($sc->nombre)
                ->insert([
                    'title' => $request->title,
                    'hora'  => $request->hora,
                    'start' => $request->fecha,
                    'end'   => $request->fecha,
                    'color' => '#1e88e5',
                    'textcolor' => '#ffffff',
                    'id_psicologo' => $request->psicologo,
                    'id_paciente' => Auth::user()->id
                ]);

        }
       
        return back();
    }
    public function getCitas(){
        $user = Auth::user();
        $sc= new sitiocentral();
        $sc->setConnection('sitiocentral');//coneccion al sitiocentral
        $sc = sitiocentral::where('tabla','=','citas')->get();
        $citas = DB::connection('sitio'.$sc[0]->sitio)->table($sc[0]->nombre)
                ->where('id_paciente','=',$user->id)
                ->get();
        $citas2 = DB::connection('sitio'.$sc[1]->sitio)->table($sc[1]->nombre)
                ->where('id_paciente','=',$user->id)
                ->get();
        $tcitas= array();
        $h=0;
        for($i=0;$i<count($citas);$i++){
            $tcitas[$i] = $citas[$i];
        }
        for($j=$i;$j<=count($citas2);$j++){
            $tcitas[$j] = $citas2[$h];
            $h++;
        }
        //dd(json_encode($citas));
        return (json_encode($tcitas));    
    }
    public function getCitasDoc(){
        $user = Auth::user();
        $sc= new sitiocentral();
        $sc->setConnection('sitiocentral');//coneccion al sitiocentral
        $sc = sitiocentral::where('tabla','=','citas')->get();
        $citas = DB::connection('sitio'.$sc[0]->sitio)->table($sc[0]->nombre)
            ->where('id_psicologo','=',$user->id)
            ->get();
            
        $citas2 = DB::connection('sitio'.$sc[1]->sitio)->table($sc[1]->nombre)
            ->where('id_psicologo','=',$user->id)
            ->get();
            //   
        $tcitas= array();
        $h=0;
        if(count($citas) > 0 ){
            for($i=0;$i<count($citas);$i++){
                $tcitas[$i] = $citas[$i];
            }   
        }
        if(count($citas2) > 0){
            if(count($citas) > 0 ){
                for($j=$i;$j<=count($citas2);$j++){
                    $tcitas[$j] = $citas2[$h];
                    $h++;
                }
            } else {
                for($j=0;$j<count($citas2);$j++){
                    $tcitas[$j] = $citas2[$j];
                    
                }
            }
            
        }
        
        $sc= new sitiocentral();
        $sc->setConnection('sitiocentral');//coneccion al sitiocentral
        $sc = sitiocentral::where('tabla','=','paciente')->first();
        if(count($tcitas) > 0){
            for($i=0;$i<count($tcitas);$i++){
                $paciente = DB::connection('sitio'.$sc->sitio)->table($sc->nombre)
                    ->where('id','=',$tcitas[$i]->id_paciente)
                    ->select('nombre','a_paterno')
                    ->first();
                $nombres[]=$paciente;
            }
            //dd($nombres);
        }else{
            $nombres = null;
        }
        //dd($citas[0]);
        //dd($nombres[0]->['nombre0']->nombre );
        
        return view('verCitas')->with('citas',$tcitas)->with('nombres',$nombres);
    }
    public function eliminarCita(Request $request){
        if($request->input('idhora') <= 15){
            $sc= new sitiocentral();
            $sc->setConnection('sitiocentral');//coneccion al sitiocentral
            $sc = sitiocentral::where('tabla','=','citas')->where('sitio','=',1)->first();
            DB::connection('sitio'.$sc->sitio)->table($sc->nombre)
                ->where('id','=',$request->idcita)
                ->delete();
        } else {
            $sc= new sitiocentral();
            $sc->setConnection('sitiocentral');//coneccion al sitiocentral
            $sc = sitiocentral::where('tabla','=','citas')->where('sitio','=',2)->first();
            DB::connection('sitio'.$sc->sitio)->table($sc->nombre)
                ->where('id','=',$request->idcita)
                ->delete();
        }
        
        return back();
    }
}
