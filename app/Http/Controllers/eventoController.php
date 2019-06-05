<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\sitiocentral;
use DB;

class eventoController extends Controller
{
    public function index(){
        $sc= new sitiocentral();//instancia del sitio central
        $sc->setConnection('sitiocentral');//coneccion al sitiocentral
        $sc = sitiocentral::where('tabla','=','evento')->first();//obetener nombres de los fragmentos
        /*$fragmento = 'App'. $sc->nombre;
        $sitio = new $fragmento();
        $sitio->setConnection('sitio'.$sc->sitio);*/
        $eventos = DB::connection('sitio'.$sc->sitio)->table($sc->nombre)
                ->get();
        //$eventos = $sitio::all();
       // dd($eventos);
        return view('muestraevento')->with('evento',$eventos);
    }

    public function formulario(){
        return view('evento');
    }

    public function store(Request $request){
        $user=Auth::user();
        $sc= new sitiocentral();//objeto de sitio central
        $sc->setConnection('sitiocentral');//coneccion al sitiocentral
        $sc = sitiocentral::where('tabla','=','evento')->get();//obetener nombres de los fragmentos
        if(count($sc) > 1 && $sc[0]->tipo == 'replica'){
            /*$clase = 'App'. $sc[0]->nombre;
            $s1= new $clase();
            $s1->setConnection('sitio'.$sc[0]->sitio);
            $s1->nombre = $request->input('nombre');
            $s1->ubicacion = $request->input('ubicacion');
            $s1->descripcion = $request->input('descripcion');
            $s1->fecha = $request->input('fecha');
            $s1->hora = $request->input('hora');
            $s1->imagen = $request->file('imagen')->store('public');
            $s1->id_psicologo = $user->id;
            $s1->save();*/
            DB::connection('sitio'.$sc[0]->sitio)->table($sc[0]->nombre)
                ->insert([
                    'nombre' => $request->nombre,
                    'ubicacion' => $request->ubicacion,
                    'descripcion' => $request->descripcion,
                    'fecha' => $request->fecha,
                    'hora' => $request->hora,
                    'imagen' => $request->file('imagen')->store('public'),
                    'id_psicologo' => $user->id
                ]);
            /*$clase = 'App'. $sc[1]->nombre;
            $s2= new $clase();
            $s2->setConnection('sitio'.$sc[1]->sitio);
            $s2->nombre = $request->input('nombre');
            $s2->ubicacion = $request->input('ubicacion');
            $s2->descripcion = $request->input('descripcion');
            $s2->fecha = $request->input('fecha');
            $s2->hora = $request->input('hora');
            $s2->imagen = $request->file('imagen')->store('public');
            $s2->id_psicologo = $user->id;
            $s2->save();*/
            DB::connection('sitio'.$sc[1]->sitio)->table($sc[1]->nombre)
                ->insert([
                    'nombre' => $request->nombre,
                    'ubicacion' => $request->ubicacion,
                    'descripcion' => $request->descripcion,
                    'fecha' => $request->fecha,
                    'hora' => $request->hora,
                    'imagen' => $request->file('imagen')->store('public'),
                    'id_psicologo' => $user->id
                ]);

            return back()->with('msjaddevento','correcto');
        } else {
            return back()->with('msjaddeventoerror','correcto');
        }

    }
    public function Inscribir(Request $request){
        $user=Auth::user();
        $sc= new sitiocentral();//objeto de sitio central
        $sc->setConnection('sitiocentral');//coneccion al sitiocentral
        $sc = sitiocentral::where('tabla','=','inscribe')->first();//obetener nombres de los fragmentos
        /*$clase = 'App'. $sc->nombre;
        $inscribe= new $clase();
        $inscribe->setConnection('sitio'.$sc->sitio);*/
        $inscrito = DB::connection('sitio'.$sc->sitio)->table($sc->nombre)
            ->where('id_evento','=',$request->id_eve)
            ->where('id_paciente','=',$user->id)
            ->first();
        //$inscrito = $inscribe::where('id_evento','=',$request->id_eve)->where('id_paciente','=',$user->id)->first();
        //dd($inscrito);
        if($inscrito != null){
            return back()->with('msjerrorins','correcto');
        }
        else{
            DB::connection('sitio'.$sc->sitio)->table($sc->nombre)
            ->insert([
                'id_evento' => $request->id_eve,
                'id_paciente' => $user->id
            ]);
            /*$inscribe->id_evento = $request->id_eve;
            $inscribe->id_paciente = $user->id;
            $inscribe->save();*/
    
            return back()->with('msjinscribir','correcto');
        }        
        
    }
    public function update(Request $request){
        $sc= new sitiocentral();//objeto de sitio central
        $sc->setConnection('sitiocentral');//coneccion al sitiocentral
        $sc = sitiocentral::where('tabla','=','evento')->get();//obetener nombres de los fragmentos
        if(count($sc) > 1 && $sc[0]->tipo == 'replica'){
            /*$clase = 'App'. $sc[0]->nombre;
            $s1= new $clase();
            $s1->setConnection('sitio'.$sc[0]->sitio);
            $eve = $s1::where('id','=',$request->id_eve)->first();
            $eve->nombre = $request->input('icon_nombre');
            $eve->ubicacion = $request->input('icon_ubicacion');
            $eve->descripcion = $request->input('icon_desc');
            $eve->fecha = $request->input('icon_fecha');
            $eve->hora = $request->input('icon_hora');
            $eve->save();
            $clase = 'App'. $sc[1]->nombre;
            $s2= new $clase();
            $s2->setConnection('sitio'.$sc[1]->sitio);
            $eve2 = $s2::where('id','=',$request->id_eve)->first();
            $eve2->nombre = $request->input('icon_nombre');
            $eve2->ubicacion = $request->input('icon_ubicacion');
            $eve2->descripcion = $request->input('icon_desc');
            $eve2->fecha = $request->input('icon_fecha');
            $eve2->hora = $request->input('icon_hora');
            $eve2->save();*/
            DB::connection('sitio'.$sc[0]->sitio)->table($sc[0]->nombre)
                ->where('id','=',$request->id_eve)
                ->update([
                    'nombre' => $request->input('icon_nombre'),
                    'ubicacion' => $request->input('icon_ubicacion'),
                    'descripcion' => $request->input('icon_desc'),
                    'fecha' => $request->input('icon_fecha'),
                    'hora' => $request->input('icon_hora')
                ]);
            DB::connection('sitio'.$sc[1]->sitio)->table($sc[1]->nombre)
                ->where('id','=',$request->id_eve)
                ->update([
                    'nombre' => $request->input('icon_nombre'),
                    'ubicacion' => $request->input('icon_ubicacion'),
                    'descripcion' => $request->input('icon_desc'),
                    'fecha' => $request->input('icon_fecha'),
                    'hora' => $request->input('icon_hora')
                ]);
            return back()->with('msjeventoupdate','correcto');
        } else {
            return back()->with('msjeventoupdateerror','correcto');   
        }
       
    }
    public function delete(Request $request){
        $sc= new sitiocentral();//objeto de sitio central
        $sc->setConnection('sitiocentral');//coneccion al sitiocentral
        $sc = sitiocentral::where('tabla','=','evento')->get();//obetener nombres de los fragmentos
        if(count($sc) > 1 && $sc[0]->tipo == 'replica'){
            /*$clase = 'App'. $sc[0]->nombre;
            $s1= new $clase();
            $s1->setConnection('sitio'.$sc[0]->sitio);
            $eve = $s1::where('id','=',$request->id_eve)->delete();

            $clase = 'App'. $sc[1]->nombre;
            $s2= new $clase();
            $s2->setConnection('sitio'.$sc[1]->sitio);
            $eve2 = $s2::where('id','=',$request->id_eve)->delete();*/
            DB::connection('sitio'.$sc[0]->sitio)->table($sc[0]->nombre)
                ->where('id','=', $request->id_eve)
                ->delete();
            DB::connection('sitio'.$sc[1]->sitio)->table($sc[1]->nombre)
                ->where('id','=', $request->id_eve)
                ->delete();

            return back()->with('msjeventodelete','correcto');
        } else {
            return back()->with('msjeventodeletefail','correcto');
        }
        
    }
}
