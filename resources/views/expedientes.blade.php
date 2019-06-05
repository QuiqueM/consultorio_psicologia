@extends('administracion')
@section('contenido')
<div class="container">
    <div>
        <h3 class="center-align">Agregar un Expediente</h3>
    </div>
    <div class="row">
        <form class="col s12" method="POST" action="{{ url('expediente/add')}}">
        {{ csrf_field() }} 
            <div class="row">
                <div class="input-field col s6">
                    <select name="paciente">
                        <option value="" disabled selected>Seleccionar</option>
                        @foreach ($paciente as $pa)
                            <option value="{{$pa->id}}">{{$pa->nombre.' '. $pa->a_paterno.' '. $pa->a_materno}}</option>
                        @endforeach
                    </select>
                    <label>Selecciona un Paciente</label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="icon_prefix" type="text" name="fecha" value="{{date('d/m/Y')}}" class="validate" required>
                    <label for="icon_prefix">Fecha</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">developer_board</i>
                    <input id="icon_prefix" type="text" name="situacion" class="validate" required>
                    <label for="icon_prefix">Situacion</label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">mood</i>
                    <input id="icon_telephone" type="text" name="avance" class="validate" required>
                    <label for="icon_telephone">Avance</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">mode_edit</i>
                    <textarea id="icon_prefix2" class="materialize-textarea" name="notas" required></textarea>
                    <label for="icon_prefix2">Notas</label>
                </div>
            </div>
            <div class="row">
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
        $(document).ready(function(){
            $('select').formSelect();
            var msj = '<?php echo(session()->has("msjaddexpe")); ?> ';
            if(msj  == true ){
                M.toast({html: 'Datos guardados correctamente!'});
            }
            var msjaddfail = '<?php echo(session()->has("msjaddexpefail")); ?> ';
            if(msjaddfail  == true ){
                M.toast({html: 'Error al guardar expediente!'});
            }
        });
    </script>
@endsection