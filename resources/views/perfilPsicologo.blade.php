@extends('administracion')
@section('contenido')
<div class="container">
   <form class="col s12 hoverable" method="POST" action="{{url('psicologo/update')}}">
       {{ csrf_field() }} 
       <div>
           <h2 class="center-align">Datos del Psicologo</h2>
       </div>
       <input type="hidden" name="idpsi" value="{{$psicologo1->id}}">
       <div class="row">
           <div class="input-field col s6">
               <i class="material-icons prefix">account_circle</i>
                <input id="icon_nombre" type="text" name="nombre" value="{{$psicologo2->nombre}}" class="validate" required>
               <label for="icon_nombre">nombre</label>
           </div>
           <div class="input-field col s6">
               <i class="material-icons prefix">school</i>
               <input id="icon_espe" type="tel" name="especialidad" value="{{$psicologo1->especialidad}}" class="validate" required>
               <label for="icon_espe">Especialidad</label>
           </div>
       </div>
       <div class="row">
           <div class="input-field col s6">
               <i class="material-icons prefix">school</i>
               <input id="icon_titulo" type="text" name="titulo" value="{{$psicologo1->titulo}}" class="validate" required>
               <label for="icon_titulo">Titulo</label>
           </div>
           <div class="input-field col s6">
               <i class="material-icons prefix">phone</i>
               <input id="icon_especialidad" type="tel" name="telefono" value="{{$psicologo2->telefono}}" class="validate" required>
               <label for="icon_especialidad">Telefono</label>
           </div>
       </div>
       <div class="row">
           <div class="center-align" style="margin-bottom:20px">
               <button class="btn waves-effect waves-light" type="submit" name="action">Actualizar<i class="material-icons right">add_circle</i>
               </button>
           </div>
       </div>
   </form>
</div>

@endsection