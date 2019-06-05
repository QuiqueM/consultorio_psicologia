@extends('administracion')
@section('contenido')
    <div class="container">
        @if (count($citas) > 0 && $nombres != null)
        <div>
            <h3 class="center-align">Tabla de citas</h3>
        </div>
        <table class="centered highlight">
            <thead>
                <tr>
                    <th>Motivo</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Paciente</th>
                    <th>Cancelar</th>
                </tr>
            </thead>

            <tbody>
                @for ($i=0;$i<count($citas);$i++)
                <form action="{{url('cancelar/cita')}}" method="post">
                    {!! csrf_field() !!}
                    <tr>
                        <input type="hidden" name="idcita" value="{{$citas[$i]->id}}">
                        <input type="hidden" name="idhora" value="{{$citas[$i]->hora}}">
                        <td>{{$citas[$i]->title}}</td>
                        <td>{{$citas[$i]->start}}</td>
                        <td>{{$citas[$i]->hora .':00 Hrs'}}</td>
                        <td>
                            {{$nombres[$i]->nombre .' '.$nombres[$i]->a_paterno}}
                        </td>
                        <td>
                            <button class="btn waves-effect red lighten-1" type="submit" name="action"><i class="material-icons center">highlight_off</i>
                            </button>
                        </td>
                    </tr>
                </form>    
                @endfor
            </tbody>
        </table>
        @else
            <h3>No tienes citas por el momento</h3>
        @endif
    </div>
@endsection