@extends('administracion')
@section('contenido')
    <div class="row">
        <form action="{{url('expediente/ver')}}" method="post">
            {!! csrf_field() !!}
            <div class="input-field col s6">
                <select name="paciente" required>
                    <option value="" disabled selected>Seleccionar</option>
                    @foreach ($pacientes as $pa)
                    <option value="{{ $pa->id}}">{{$pa->nombre.' '.$pa->a_paterno.' '.$pa->a_materno}} </option>
                    @endforeach
                </select>
                <label>Seleccionar a un paciente</label>
            </div>
            <div class="col s4" style="margin-left:25px; margin-top:15px">
                <button class="btn waves-effect waves-light" type="submit" name="action">buscar<i class="material-icons right">add_circle</i>
                </button>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col s6">
            <table class="centered">
                <thead>
                  <tr>
                      <th>Situación</th>
                      <th>Fecha</th>
                      <th>Acción</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($expediente as $exp)
                        <form action="{{url('expediente/buscar')}}" method="post">
                            {!! csrf_field() !!}
                            <tr>
                            <input type="hidden" name="idExp" value="{{$exp->id}}">
                                <td>{{$exp->situacion}}</td>
                                <td>{{$exp->fecha}}</td>
                                <td>
                                    <button class="btn waves-effect blue lighten-2" type="submit"      name="action">Ver<i class="material-icons right">visibility</i>
                                    </button>
                                </td>
                            </tr>
                        </form>
                    @endforeach    
                </tbody>
            </table>
        </div>
        @if ($activo != null)
            <div class=" col s6">
                <blockquote>
                    <p><b><i>Fecha:</i></b>{{$activo->fecha}}</p>
                    <p><b><i>Situación:</i></b>{{$activo->situacion}}</p>
                    <p><b><i>Fecha:</i></b>{{$activo->avance . '%'}}</p>
                    <p><b><i>Notas:</i></b>{{$activo->notas}}</p>
                </blockquote>
            </div>
        @endif
    </div>
@endsection

