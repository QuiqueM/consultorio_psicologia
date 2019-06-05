@extends('index')
@section('contenido')
    <div class="container">
        @if (Auth::user() == null)
            <div class="card-panel teal lighten-2">Registrate para que puedas asistir a nuestros eventos</div>
        @endif
        <div class="carousel">
            @foreach ($evento as $eve)
            <a class="carousel-item " ondblclick="datos('{{$eve->id}}','{{$eve->nombre}}','{{$eve->ubicacion}}','{{$eve->descripcion}}','{{$eve->fecha}}','{{$eve->hora}}')"><img src="{{Storage::url($eve->imagen)}}"></a>
            @endforeach
        </div>
        <blockquote>
            <p>1-Para navegar en las imagenes da un click sobre ella.</p> 
            <p>2-Para abrir la información de un evento da dos click sobre la imagen.</p> 
        </blockquote>
    </div>
    @if (Auth::user() != null)
        <!-- Modal Structure -->
    <div id="modal1" class="modal">
        <form id="form_evento" action="" method="post">
        {{ csrf_field() }}
            <div class="modal-content">
            <h4>Datos del Evento</h4>
                <div class="row">
                    <input type="hidden" id="id_eve" name="id_eve">
                    <div class="input-field ">
                        <i class="material-icons prefix">pin_drop</i>
                        <input id="icon_nombre" name="icon_nombre" type="text" value=" " class="validate" @if (Auth::user()->rol == 'paciente')
                            disabled
                        @endif required >
                        <label for="icon_nombre">Nombre del Evento</label>
                    </div>
                    <div class="input-field ">
                        <i class="material-icons prefix">pin_drop</i>
                        <input id="icon_ubicacion" name="icon_ubicacion" type="text" value=" " class="validate" required @if (Auth::user()->rol == 'paciente')
                        disabled
                    @endif>
                        <label for="icon_ubicacion">Ubicación</label>
                    </div>
                    <div class="input-field ">
                        <i class="material-icons prefix">message</i>
                        <input id="icon_desc" name="icon_desc" type="text" value=" " class="validate" required @if (Auth::user()->rol == 'paciente')
                        disabled
                    @endif>
                        <label for="icon_desc">Descripcion</label>
                    </div>
                    <div class="input-field ">
                        <i class="material-icons prefix">event</i>
                        <input  id="icon_fecha" name="icon_fecha" type="text" value=" " class="datepicker" required @if (Auth::user()->rol == 'paciente')
                        disabled
                    @endif>
                        <label for="icon_fecha">Fecha</label>
                    </div>
                    <div class="input-field ">
                        <i class="material-icons prefix">access_time</i>
                        <input id="icon_hora" name="icon_hora" type="text" value=" " class="timepicker" required @if (Auth::user()->rol == 'paciente')
                        disabled
                    @endif>
                        <label for="icon_hora">Hora</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                @if (Auth::user() != null && Auth::user()->rol == 'paciente')
                    <button class="modal-close waves-effect waves-blue btn-flat" onclick="inscribir()" type="submit">Inscribir</button>
                @endif
                @if (Auth::user() != null && Auth::user()->rol == 'psicologo')
                    <button class="modal-close waves-effect waves-yellow btn-flat" onclick="actualizar()" type="submit">Actualizar</button>
                    <button class="modal-close waves-effect waves-red btn-flat" onclick="borrar()" type="submit">Borrar</button>
                @endif
            </div>
        </form>
    </div>
    @endif
     
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('.carousel').carousel();
            $('.modal').modal();
            var incribir = '<?php echo(session()->has("msjinscribir")); ?> ';
            if(incribir  == true ){
                M.toast({html: 'Inscripción correcta!'});
            }
            var eventoupdate = '<?php echo(session()->has("msjeventoupdate")); ?> ';
            if(eventoupdate  == true ){
                M.toast({html: 'Actualización correcta!'});
            }
            var eventoupdateerror = '<?php echo(session()->has("msjeventoupdateerror")); ?> ';
            if(eventoupdateerror  == true ){
                M.toast({html: 'Error al actualizar!'});
            }
            var eventodelete = '<?php echo(session()->has("msjeventodelete")); ?> ';
            if(eventodelete  == true ){
                M.toast({html: 'Eliminación correcta!'});
            }
            var eventodeletefail = '<?php echo(session()->has("msjeventodeletefail")); ?> ';
            if(eventoupdatefail  == true ){
                M.toast({html: 'Error al eliminar!'});
            }
            var errorins = '<?php echo(session()->has("msjerrorins")); ?> ';
            if(errorins  == true ){
                M.toast({html: 'Ya estas inscrito a este evento! Elije otro'});
            }
        });
        function datos(id,nombre,ubicacion,descripcion,fecha,hora){
            $('#id_eve').attr('value',id);
            $('#icon_nombre').attr('value',nombre);
            $('#icon_ubicacion').attr('value',ubicacion);
            $('#icon_desc').attr('value',descripcion);
            $('#icon_fecha').attr('value',fecha);
            $('#icon_hora').attr('value',hora);
            $('#modal1').modal('open');
        }
        function actualizar(){
            $('#form_evento').attr('action','{{url("evento/update")}}')
        }
        function borrar(){
            $('#form_evento').attr('action','{{url("evento/delete")}}')
        }
        function inscribir(){
            $('#form_evento').attr('action','{{url("evento/inscribir")}}')
        }
    </script>

@endsection