@extends('administracion')
@section('contenido')
<div class="container">
    @if (count($psicologo1) > 0 )
        <table class="centered highlight">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nombre</th>
                    <th>Titulo</th>
                    <th>Perfil</th>
                    <th>Borrar</th>
                </tr>
            </thead>

            <tbody>
                @for ($i=0;$i<count($psicologo1);$i++)
                <form id="psicologo" action="{{url('psicologoPerfil')}}" method="post">
                    {!! csrf_field() !!}
                    <tr>
                        <input type="hidden" name="idpsi" value="{{$psicologo1[$i]->id}}">
                        <td>{{$i+1}}</td>
                        <td>{{$psicologo2[$i]->nombre}}</td>
                        <td>{{$psicologo1[$i]->titulo}}</td>
                        <td>
                            <button class="btn waves-effect yellow lighten-1"  type="submit" name="action"><i class="material-icons center">visibility</i>
                            </button>
                        </td>
                </form>         
                        <td>
                            <button class="btn waves-effect red lighten-1" onclick="borrar({{$psicologo1[$i]->id}})" type="button" name="action"><i class="material-icons center">highlight_off</i>
                            </button>
                        </td>
                    </tr>   
                @endfor
            </tbody>
        </table>
    @else
        <h3>No se pueden mostrar en este momento</h3>
    @endif
</div>
<!-- Modal Structure -->
<div id="modal1" class="modal">
    <form action="{{url('psicologo/borrar')}}" method="post">
        {!! csrf_field() !!}
        <div class="modal-content">
            <h4>Eliminar Psicologo</h4>
            <p><b><i>¿Esta seguro?</i></b></p>
            <p>Para eliminarlo primero verifica que no tenga citas pendientes</p>
            <p>Se eliminaran los datos personales, su correo y contraseña, las citas que tenga pendientes y los pacientes asosiados quedaran libres para asosiar con otro psicologo.</p>
            <input type="hidden" name="idpsicologo" id="idpsicologo" value="">
        </div>
        <div class="modal-footer">
            <button type="submit" class="modal-close waves-effect waves-red btn-flat">Aceptar</button>
        </div>
    </form>
</div>
@endsection
@section('script')
    <script>
        $(function(){
            var msjdeletepsi = '<?php echo(session()->has("msjdeletepsi")); ?> ';
            if(msjdeletepsi  == true ){
                M.toast({html: 'Eliminado correctamente!'});
            }
            var msjupdatepsi = '<?php echo(session()->has("msjupdatepsi")); ?> ';
            if(msjupdatepsi  == true ){
                M.toast({html: 'Actualizado correctamente!'});
            }
            var msjerrordeletepsi = '<?php echo(session()->has("msjerrordeletepsi")); ?> ';
            if(msjerrordeletepsi  == true ){
                M.toast({html: 'porfavor cancele las citas antes!'});
            }
        });
        function borrar(id){
            $('.modal').modal();
           $('#idpsicologo').val(id);
           $('#modal1').modal('open');
        }
    </script>
@endsection