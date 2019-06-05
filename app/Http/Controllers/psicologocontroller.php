<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\sitiocentral;
use DB;

class psicologocontroller extends Controller
{
    public function index()
    {
        return  view('psicologo');
    }

    public function store(Request $request){
        $user = new User();
        $user->setConnection('sitio1');
        User::create([
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'rol' => 'psicologo'
        ]);
        //obtener usuario registrado
        $idus=User::where('email','=',$request->input('email'))->first();
        //buscar en el sitio centra
        $sc = new sitiocentral();
        $sc->setConnection('sitiocentral');
        $sc = sitiocentral::where('tabla','=','psicologo')->get();
        if(count($sc) > 1 && $sc[0]->tipo == 'vertical'){
            DB::connection('sitio'.$sc[0]->sitio)->table($sc[0]->nombre)->insert([
                'id' =>$idus->id,
                'titulo' => $request->input('titulo'),
                'especialidad' => $request->input('especialidad')
            ]);
            DB::connection('sitio'.$sc[1]->sitio)->table($sc[1]->nombre)->insert([
                'id' => $idus->id,
                'nombre' => $request->input('nombre'),
                'telefono' => $request->input('telefono')
            ]);

            return back()->with('msjaddpsi','correcto');
        } else {
            return back()->with('msjerroraddpsi','correcto');
        }

        
    }
    public function muestraDoc(){
        $sc = new sitiocentral();
        $sc->setConnection('sitiocentral');
        $sc = sitiocentral::where('tabla','=','psicologo')->get();
        if(count($sc) > 1 && $sc[0]->tipo == 'vertical'){
            $psicologo1 = DB::connection('sitio'.$sc[0]->sitio)->table($sc[0]->nombre)->get();
            $psicologo2=DB::connection('sitio'.$sc[1]->sitio)->table($sc[1]->nombre)->get();
        }
        return view('verPsicologo',compact('psicologo1','psicologo2'));
    }

    public function perfil(Request $request){
        $sc = new sitiocentral();
        $sc->setConnection('sitiocentral');
        $sc = sitiocentral::where('tabla','=','psicologo')->get();
        if(count($sc) > 1 && $sc[0]->tipo == 'vertical'){
            $psicologo1 =  DB::connection('sitio'.$sc[0]->sitio)
                ->table($sc[0]->nombre)
                ->where('id','=', $request->idpsi)
                ->first();
            $psicologo2 =  DB::connection('sitio'.$sc[1]->sitio)
                ->table($sc[1]->nombre)
                ->where('id','=', $request->idpsi)
                ->first();
        }
        return view('perfilPsicologo',compact('psicologo1','psicologo2'));
    }
    public function update(Request $request){
        $sc = new sitiocentral();
        $sc->setConnection('sitiocentral');
        $sc = sitiocentral::where('tabla','=','psicologo')->get();
        if(count($sc) > 1 && $sc[0]->tipo == 'vertical'){
            DB::connection('sitio'.$sc[0]->sitio)->table($sc[0]->nombre)
                ->where('id','=', $request->idpsi)
                ->update([
                    'titulo' => $request->input('titulo'),
                    'especialidad' =>  $request->input('especialidad'),
                ]);
            DB::connection('sitio'.$sc[1]->sitio)->table($sc[1]->nombre)
                ->where('id','=', $request->idpsi)
                ->update([
                    'nombre' => $request->input('nombre'),
                    'telefono' =>  $request->input('telefono'),
                ]);
        }
        return redirect('/VerPsicologo')->with('msjupdatepsi','correcto');
    }
    public function delete(Request $request){
        $sc = new sitiocentral();
        $sc->setConnection('sitiocentral');
        $sc = sitiocentral::where('tabla','=','citas')->where('sitio','=',1)->first();
        $citas = DB::connection('sitio'.$sc->sitio)->table($sc->nombre)
            ->where('id_psicologo','=',$request->idpsicologo)
            ->first();
        if($citas == null){
            $user = new User();
            $user->setConnection('sitio1');
            $idus=User::where('id','=',$request->idpsicologo)->delete();
            $sc = new sitiocentral();
            $sc->setConnection('sitiocentral');
            $sc = sitiocentral::where('tabla','=','psicologo')->get();
            //eliminar datos del psicologo
            if(count($sc) > 1 && $sc[0]->tipo == 'vertical'){
                DB::connection('sitio'.$sc[0]->sitio)->table($sc[0]->nombre)
                    ->where('id','=', $request->idpsicologo)
                    ->delete();
                DB::connection('sitio'.$sc[0]->sitio)->table($sc[0]->nombre)
                    ->where('id','=', $request->idpsicologo)
                    ->delete();
            }
            $sc = new sitiocentral();
            $sc->setConnection('sitiocentral');
            $sc = sitiocentral::where('tabla','=','paciente')->first();
            //actualizar datos del paciente para que quede libre y pueda ser resignado
            $actualizar = DB::connection('sitio'.$sc->sitio)->table($sc->nombre)
                ->where('id_psicologo','=', $request->idpsicologo)
                ->get();
            if($actualizar != null){
                for($i=0;$i<count($actualizar);$i++){
                    DB::connection('sitio'.$sc->sitio)->table($sc->nombre)
                        ->where('id','=', $actualizar[$i]->id)
                        ->update([
                            'id_psicologo' => -1
                        ]);
                }
            }

            return back()->with('msjdeletepsi','correcto');

        } else {
            //si tiene alguna cita regresar un mensaje de que borre todas las citas
            return back()->with('msjerrordeletepsi','correcto');
        }
    }
}
