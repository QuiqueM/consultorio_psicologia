 @extends('administracion')
 @section('contenido')
 <div class="container">
    <form class="col s12 hoverable" method="POST" action="{{url('psicologo/add')}}">
        {{ csrf_field() }} 
        <div>
            <h2 class="center-align">Agregar Psicologo</h2>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">account_circle</i>
                <input id="icon_nombre" type="text" name="nombre" class="validate" required>
                <label for="icon_nombre">nombre</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">school</i>
                <input id="icon_espe" type="tel" name="especialidad" class="validate" required>
                <label for="icon_espe">Especialidad</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">school</i>
                <input id="icon_titulo" type="text" name="titulo" class="validate" required>
                <label for="icon_titulo">Titulo</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">phone</i>
                <input id="icon_especialidad" type="tel" name="telefono" class="validate" required>
                <label for="icon_especialidad">Telefono</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">mail</i>
                <input id="icon_email" type="email" name="email" class="validate" required>
                <label for="icon_email">Correo</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">vpn_key</i>
                <input id="icon_password" type="password" name="password" class="validate" required>
                <label for="icon_password">Contraseña</label>
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

 @endsection
 @section('script')
 <script>
    $(function(){
        var addpsi = '<?php echo(session()->has("msjaddpsi")); ?> ';
        if(addpsi  == true ){
            M.toast({html: 'Datos guardados correctamente!'});
        }
        var erroraddpsi = '<?php echo(session()->has("msjadderrorpsi")); ?> ';
        if(erroraddpsi  == true ){
            M.toast({html: 'Error de conexion, no se puedo agregar!'});
        }
    });
</script>
 @endsection