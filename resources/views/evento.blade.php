@extends('administracion')
@section('contenido')
    <div class="container">
        <div class="row">
        <form class="col s12" method="POST" action="{{ url('evento/add')}}" enctype="multipart/form-data">
            {{ csrf_field() }} 
                <div class="center">
                    <h3>Agrega un Evento</h3>
                </div>
                <div class="row">
                    <div class="input-field ">
                        <i class="material-icons prefix">web</i>
                        <input id="icon_nombre" type="text" name="nombre" class="validate" required>
                        <label for="icon_nombre">Nombre del Evento</label>
                    </div>
                    <div class="input-field ">
                        <i class="material-icons prefix">pin_drop</i>
                        <input id="icon_ubicacion" type="text" name="ubicacion" class="validate" required>
                        <label for="icon_ubicacion">Ubicación</label>
                    </div>
                    <div class="input-field ">
                        <i class="material-icons prefix">message</i>
                        <input id="icon_desc" type="text" name="descripcion" class="validate" required>
                        <label for="icon_desc">Descripcion</label>
                    </div>
                    <div class="input-field ">
                        <i class="material-icons prefix">event</i>
                        <input  id="icon_fecha" type="text" name="fecha" class="datepicker" required>
                        <label for="icon_fecha">Fecha</label>
                    </div>
                    <div class="input-field ">
                        <i class="material-icons prefix">access_time</i>
                        <input id="icon_hora" type="text" name="hora" class="timepicker" required>
                        <label for="icon_hora">Hora</label>
                    </div>
                    <div class="file-field input-field">
                        <div class="btn">
                            <span>Imagen</span>
                            <input type="file" name="imagen" multiple>
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" placeholder="Elegir una  imagen para el evento">
                        </div>
                    </div>
                    <div class="center-align" style="margin-bottom:20px">
                        <button class="btn waves-effect waves-light" type="submit" name="action">Agregar<i class="material-icons right">add_circle</i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function(){  
            $('.datepicker').datepicker(); 
            $('.timepicker').timepicker();
            var addevento = '<?php echo(session()->has("msjaddevento")); ?> ';
            if(addevento  == true ){
                M.toast({html: 'Datos guardados correctamente!'});
            } 
            var addeventoerror = '<?php echo(session()->has("msjaddeventoerror")); ?> ';
            if(addeventoerror  == true ){
                M.toast({html: 'Error al guardar datos!'});
            }         
        }); // end of document ready
    </script>
@endsection