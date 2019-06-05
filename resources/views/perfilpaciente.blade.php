@extends('index')
@section('contenido')
<div class="container">
    @if ($usuario == null)
    <form class="col s12 hoverable" method="POST" action="{{ url('perfil/add') }}">
        {{ csrf_field() }} 
        <div>
            <h2 class="center-align">Bienvenido</h2>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">account_circle</i>
                <input id="icon_nombre" type="text" name="nombre" class="validate" required>
                <label for="icon_nombre">nombre</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">account_box</i>
                <input id="icon_ap1" type="tel" name="ap1" class="validate" required>
                <label for="icon_ap1">Apellido Paterno</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">account_box</i>
                <input id="icon_ap2" type="text" name="ap2" class="validate" required>
                <label for="icon_ap2">Apellido Materno</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">location_on</i>
                <input id="icon_calle" type="text" name="calle" class="validate" required>
                <label for="icon_calle">Calle</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">store</i>
                <input id="icon_numero" type="text" name="numero" class="validate" required>
                <label for="icon_numero">Numero</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">location_city</i>
                <input id="icon_colonia" type="text" name="colonia" class="validate" required>
                <label for="icon_colonia">Colonia</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">cake</i>
                <input id="icon_edad" type="number" name="edad" class="validate" required>
                <label for="icon_edad">Edad</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">phone</i>
                <input id="icon_tel" type="tel" name="telefono" class="validate" required>
                <label for="icon_tel">Telefono</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">phone</i>
                <input id="icon_tel" type="tel" name="telefono_contacto" class="validate" required>
                <label for="icon_tel">Telefono de un familiar</label>
            </div>
        </div>
        <div class="center-align" style="margin-bottom:20px">
            <button class="btn waves-effect waves-light" type="submit" name="action">Confirmar<i class="material-icons right">add_circle</i>
            </button>
        </div>
    </form>
    @else
    <form class="col s12 hoverable" method="POST" action="{{ url('perfil/update') }}">
        {{ csrf_field() }} 
        <div>
            <h2 class="center-align">Datos del usuario</h2>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">account_circle</i>
                <input id="icon_nombre" type="text" name="nombre" value="{{$usuario->nombre}}" class="validate" required>
                <label for="icon_nombre">nombre</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">account_box</i>
                <input id="icon_ap1" type="tel" name="ap1" value="{{$usuario->a_paterno}}" class="validate" required>
                <label for="icon_ap1">Apellido Paterno</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">account_box</i>
                <input id="icon_ap2" type="text" name="ap2" value="{{$usuario->a_materno}}" class="validate" required>
                <label for="icon_ap2">Apellido Materno</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">location_on</i>
                <input id="icon_calle" type="text" name="calle" value="{{$usuario->calle}}" class="validate" required>
                <label for="icon_calle">Calle</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">store</i>
                <input id="icon_numero" type="text" name="numero" value="{{$usuario->numero}}" class="validate" required>
                <label for="icon_numero">Numero</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">location_city</i>
                <input id="icon_colonia" type="text" name="colonia" value="{{$usuario->colonia}}" class="validate" required>
                <label for="icon_colonia">Colonia</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">cake</i>
                <input id="icon_edad" type="text" name="edad" value="{{$usuario->edad}}" class="validate" required>
                <label for="icon_edad">Edad</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">phone</i>
                <input id="icon_tel" type="tel" name="telefono" value="{{$usuario->telefono}}" class="validate" required>
                <label for="icon_tel">Telefono</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">phone</i>
                <input id="icon_tel" type="tel" name="telefono_contacto" value="{{$usuario->telefono_contacto}}" class="validate" required>
                <label for="icon_tel">Telefono de un familiar</label>
            </div>
        </div>
        <input type="hidden" name="id_psico" value="{{$usuario->id_psicologo}}">
        <div class="center-align" style="margin-buttom:20px">
            <button class="btn waves-effect waves-light" type="submit" name="action">Actualizar<i class="material-icons right">add_circle</i>
            </button>
        </div>
    </form>   
    @endif
    
</div>
@endsection
@section('script')
    <script>
        $(function(){
            M.AutoInit();
            var msj = '<?php echo(session()->has("msj")); ?> ';
            if(msj  == true ){
                M.toast({html: 'Datos guardados correctamente!'});
            }
        });
    </script>
@endsection