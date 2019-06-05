
@extends('index')
@section('contenido')
<div class="row" style="margin-top:40px">
    <form class="col s4 offset-s4 hoverable" method="POST" >
        <div>
            <h2 class="center-align">Registrarse</h2>
        </div>
        <div class="input-field ">
          <i class="material-icons prefix">account_circle</i>
          <input id="email" type="email" name="email" class="validate" value="{{old('email')}}">
          <label for="email">Correo Electronico</label>
        </div>
        <div class="input-field">
          <i class="material-icons prefix">lock</i>
          <input id="password" type="password" name="password" class="validate" >
          <label for="password">Contraseña</label>
        </div>
        <div class="input-field">
            <i class="material-icons prefix">lock</i>
            <input id="pasword2" type="password" name="password2" class="validate">
            <label for="pasword2">Confirma Contraseña</label>
          </div>
        <div class="center-align" style="margin-bottom:20px">
            <button class="btn waves-effect waves-light" type="submit" name="action">Registrarse<i class="material-icons right">add_circle</i>
            </button>
        </div>
    </form>
</div>

@endsection

