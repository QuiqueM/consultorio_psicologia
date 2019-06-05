<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $user = Auth::user();
    if($user != null){
        if($user->rol == 'paciente'){
            $sc= new App\sitiocentral();
            $sc->setConnection('sitiocentral');//coneccion al sitiocentral
            $sc = App\sitiocentral::where('tabla','=','paciente')->first();//obetener nombres de los fragmentos
            /*$clase = 'App'. $sc->nombre;
            $sitio = new $clase();
            $sitio->setConnection('sitio'.$sc->sitio);
            $paciente = $sitio::where('id','=',$user->id)->first();*/
            $paciente = DB::connection('sitio'.$sc->sitio)->table($sc->nombre)
            ->where('id','=',$user->id)
            ->first();
            if ($paciente == null) {
                $nuevo = true;
            } else {
                
                $nuevo = false;
            }
        } else {
            $nuevo = false;
        }
    } else {
        $nuevo = false;
    }
    
    
    return response()->view('index', compact('nuevo'), 200);
});
Route::get('/administrador','administracionController@index');
Route::post('/administrador/add','administracionController@store');
Route::get('/psicologo','psicologocontroller@index');
Route::post('/psicologo/add','psicologocontroller@store');
Route::get('/VerPsicologo','psicologocontroller@muestraDoc');
Route::post('/psicologoPerfil','psicologocontroller@perfil');
Route::post('/psicologo/update','psicologocontroller@update');
Route::post('/psicologo/borrar','psicologocontroller@delete');
Route::get('/evento/formulario','eventocontroller@formulario');
Route::get('/evento','eventocontroller@index');
Route::post('/evento/add','eventocontroller@store');
Route::post('/evento/update','eventocontroller@update');
Route::post('/evento/delete','eventocontroller@delete');
Route::post('/evento/inscribir','eventocontroller@Inscribir');
Route::get('/expediente','expedienteController@index');
Route::post('/expediente/add','expedienteController@store');
Route::post('/expediente/ver','vistaExp@index');
Route::post('/expediente/buscar','buscarController@index');
Route::post('/paciente/eliminar','administracionController@borrarPaciente');
Route::get('/citas','citasController@index');
Route::get('/citasDoc','citasController@getCitasDoc');
Route::get('/citas1','citasController@getCitas');
Route::post('/citas/add','citasController@store');
Route::post('/cancelar/cita','citasController@eliminarCita');
Route::post('/registro','registroController@store');
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});
Route::get('/perfil','pacienteController@index');
Route::post('/perfil/add','pacienteController@store');
Route::post('/perfil/update','pacienteController@update');
Route::get('/pdfEvento', function(){
    $sc= new App\sitiocentral();
    $sc->setConnection('sitiocentral');//coneccion al sitiocentral
    $sc = App\sitiocentral::where('tabla','=','evento')->first();//obetener nombres de los fragmentos
    /*$clase = 'App'. $sc->nombre;
    $sitio = new $clase();
    $sitio->setConnection('sitio'.$sc->sitio);
    $evento = $sitio::select('id','nombre')->get();*/
    $evento = DB::connection('sitio'.$sc->sitio)->table($sc->nombre)
        ->select('id','nombre')
        ->get()
        ->groupBy('id');
    $sc= new App\sitiocentral();
    $sc->setConnection('sitiocentral');//coneccion al sitiocentral
    $sc = App\sitiocentral::where('tabla','=','inscribe')->first();//obetener nombres de los fragmentos
    /*$clase = 'App'. $sc->nombre;
    $sitio = new $clase();
    $sitio->setConnection('sitio'.$sc->sitio);
    $inscrito = $sitio::all()->groupBy('id_evento');*/
    $inscrito = DB::connection('sitio'.$sc->sitio)->table($sc->nombre)
        ->get()
        ->groupBy('id_evento');
    //dd($inscrito);
    //dd($evento);
    $h=0;
    $pdf=PDF::loadView('pdfEvento',['evento'=>$evento,'ins' => $inscrito,'h'=>$h]);
    return $pdf->stream();
});
Route::get('/pdfUsuario', function(){
    /*$sc= new App\sitiocentral();
    $sc->setConnection('sitiocentral');//coneccion al sitiocentral
    $sc = App\sitiocentral::where('tabla','=','paciente')->first();//obetener nombres de los fragmentos
    $clase = 'App'. $sc->nombre;
    $sitio = new $clase();
    $sitio->setConnection('sitio'.$sc->sitio);*/
    $año = Date('Y');
    $mes =Date('m');
    
    $usuarios=App\User::where('rol','=','paciente')->whereYear('created_at', $año)->whereMonth('created_at', $mes)->get();
    $pasado=App\User::where('rol','=','paciente')->whereYear('created_at', $año)->whereMonth('created_at', $mes-1)->get();
    $total=App\User::where('rol','=','paciente')->get()->count();
   
    $pdf=PDF::loadView('pdfUsuarios',['usuario'=>$usuarios,'pasado'=>$pasado,'total'=>$total]);
    return $pdf->stream();
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
