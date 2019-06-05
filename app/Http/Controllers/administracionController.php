<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sitiocentral;
use Auth;
use App\User;
use DB;

class administracionController extends Controller
{
    public function index(){
        $psicologo = Auth::user();//obtener datos del psicologo loggeado
        $sc= new sitiocentral();
        $sc->setConnection('sitiocentral');//coneccion al sitiocentral
        $sc = sitiocentral::where('tabla','=','paciente')->first();//obetener nombres de los fragmentos
        //$clase = 'App'. $sc->nombre;
        //$sitio = new $clase();
        //$sitio->setConnection('sitio'.$sc->sitio);
        //traer a los pacientes que a un no tienen un psicologo
        $addpaciente = DB::connection('sitio'.$sc->sitio)->table($sc->nombre)
            ->where('id_psicologo','=',-1)
            ->get();
        //$addpaciente = $sitio::where('id_psicologo','=',-1)->get();
        //traer a los pacientes que esten con el psicologo que ha iniciado sesion.
        $paciente = DB::connection('sitio'.$sc->sitio)->table($sc->nombre)
            ->where('id_psicologo','=', $psicologo->id)
            ->get();
        //$paciente = $sitio::where('id_psicologo','=',$psicologo->id)->get();
        return view('administracion')->with('pacientes',$addpaciente)->with('registrados',$paciente);
    }
    public function store(Request $request){
        $psicologo = Auth::user();//datos del psiclogo que este logeado
        $sc= new sitiocentral();
        $sc->setConnection('sitiocentral');//coneccion al sitiocentral
        $sc = sitiocentral::where('tabla','=','paciente')->first();//obetener nombres de los fragmentos
        if( $sc != null){
            //asiganar un psicologo a un paciente
            DB::connection('sitio'.$sc->sitio)->table($sc->nombre)
                ->where('id','=',$request->input('paciente'))
                ->update(['id_psicologo' => $psicologo->id]);
            
            return back()->with('msjadd','correcto');
        }else{
            return back()->with('msjadderror','correcto');
        }
        
    }
    public function borrarPaciente(Request $request){
        $sc= new sitiocentral();
        $sc->setConnection('sitiocentral');//coneccion al sitiocentral
        $sc = sitiocentral::where('tabla','=','citas')->where('sitio','=',2)->first();
        if($sc == null){
            $sc= new sitiocentral();
            $sc->setConnection('sitiocentral');//coneccion al sitiocentral
            $sc = sitiocentral::where('tabla','=','paciente')->first();//obetener nombres de los fragmentos
            //borar datos del paciente y su usuario
            DB::connection('sitio'.$sc->sitio)->table($sc->nombre)
                    ->where('id','=',$request->input('idpa'))
                    ->delete();
            //$b1 = $sitio::where('id','=',$request->idpa)->delete();
            $b2 = User::where('id','=',$request->idpa)->delete();
            $sc= new sitiocentral();
            $sc->setConnection('sitiocentral');//coneccion al sitiocentral
            $sc = sitiocentral::where('tabla','=','expediente')->first();//obetener nombres de los fragmentos
            if($sc != null){
                //elimnar expedientes del paciente
                $expedientes = DB::connection('sitio'.$sc->sitio)->table($sc->nombre)
                    ->where('id_paciente','=',$request->input('idpa'))
                    ->get();
                for($i=0;$i<count($expedientes);$i++){
                    DB::connection('sitio'.$sc->sitio)->table($sc->nombre)
                    ->where('id','=',$expedientes[$i]->id)
                    ->delete();
                }    
                
                return back()->with('mjsdelete','correcto');
            }
        
        } else {
            return back()->with('mjsdeletefail','correcto');
        } 
        
    }
}
