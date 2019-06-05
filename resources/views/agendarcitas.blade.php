@extends('index')
@section('contenido')
@if ($nuevo == false)
    <div class="container" id="calendar"></div>
@endif
 <!-- Modal usuario nuevo -->
<div id="modal2" class="modal">
    <div class="modal-content">
        <h4>Usuario Nuevo</h4>
        <p>Hemos detectado que eres un usuario nuevo.</p>
        <p>Para agendar tu primera cita por favor comunicate al telefono <b>01-800-234-56</b></p>
    </div>
    <div class="modal-footer">
        <a href="/" class="modal-close waves-effect waves-green btn-flat">Aceptar</a>
    </div>
</div>
 <!-- Modal cancelar cita --> 
<div id="modal3" class="modal">
    <form action="{{url('cancelar/cita')}}" method="post">
        {!! csrf_field() !!}
        <div class="modal-content">
            <h4>Cancelar Cita</h4>
            <p><b>¿Ests seguro de cancelar tu cita?</b></p>
            <input type="hidden" id="idcita" name="idcita" value="">
        </div>
        <div class="modal-footer">
            <button type="submit" class="modal-close waves-effect waves-red btn-flat">Aceptar</button>
        </div>
    </form>
</div>
 <!-- Modal agenda cita -->
<div id="modal1" class="modal">
    <div class="row">
        <form class="col-s8" method="POST" action="{{url('citas/add')}}">
        {!! csrf_field() !!}
            <div class="modal-content">
                <h4>Agenda tu cita</h4>
                <div class="row">
                    <div class="input-field col s6">
                        @if ($psicologo != null)
                        <input type="hidden" name="psicologo" value="{{$psicologo->id}}" >
                        <i class="material-icons prefix">account_circle</i>
                        <input value="{{$psicologo->nombre}}" id="nombre" type="text" name="" class="validate" required>
                        <label class="active" for="nombre">Psicologo</label>
                        @endif
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input  id="fecha" type="text" name="fecha" value=" " class="validate" required>
                        <label class="active" for="fecha">Fecha</label>
                    </div>
                    <div class="input-field col s6">
                        <select name="hora" required>
                            <option value="" disabled selected>Seleccionar</option>
                            <option value="10">10:00 am</option>
                            <option value="12">12:00 pm</option>
                            <option value="16">04:00 pm</option>
                            <option value="18">06:00 pm</option>
                        </select>
                        <label>Selecciona una Hora</label>
                    </div>
                    <div class="input-field col s6">
                        <select name="title" required>
                            <option value="Sesión Terapeutica" selected>Sesión Terapeutica</option>
                        </select>
                        <label>Selecciona una Hora</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="modal-close waves-effect waves-green btn-flat">Agregar</button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
    <script>
        $(function() {
            var nuevoEvento;
            var id;
            $('.modal').modal();
            $('select').formSelect();
            var newa = '<?php echo $nuevo;?>';
            if(newa == true){
                $('#modal2').modal('open');
            }
            
            $('#calendar').fullCalendar({
                    header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,listMonth'
                },
                dayClick: function(date, jsEvent, view){
                    var check = date.format('YYYY-MM-DD');
                    var today = moment(new Date()).format('YYYY-MM-DD');
                    if(check >=today){
                        $('#fecha').val(date.format());
                        $('#modal1').modal('open');
                    }
                    
                },
                events:'http://127.0.0.1:8000/citas1',    

                eventClick: function (calEvent,jsEvent,view) {
                   $('#idcita').val(calEvent.id);
                   $('#modal3').modal('open');
                }
            });

            $('#newAgregar').click(function(){
                $('#formulario').attr('action', '{{url("evento/addEvento")}}');
                $('#calendar').fullCalendar('renderEvent',nuevoEvento);
                $('#newEvento').modal('toggle');
            });
            $('#eliminar').click(function(){
                $('#formulario').attr('action', '{{url("evento/deleteEvento")}}');
            });
        });
    </script>
@endsection