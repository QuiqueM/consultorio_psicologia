<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Psicologia</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link rel="stylesheet" href="fullcalendar/fullcalendar.css">
        
    </head>
    <body>
        <ul id="dropdown1" class="dropdown-content">
            <li><a href="/login">Iniciar Sesión</a></li>
            <li class="divider"></li>
            <li><a href="/register">Registrarse</a></li>
        </ul>
        <ul id="dropdown2" class="dropdown-content">
            <li><a href="/administrador">Menu</a></li>
            <li class="divider"></li>
            <li><a href="/logout">Cerrar Sesion</a></li>
        </ul>
        <ul id="dropdown3" class="dropdown-content">
            <li><a href="/evento/formulario">Agregar Evento</a></li>
            <li class="divider"></li>
            <li><a href="/evento">Mostrar Evento</a></li>
        </ul>
        <ul id="dropdown4" class="dropdown-content">
            <li><a href="/psicologo">Agregar Psicologo</a></li>
            <li class="divider"></li>
            <li><a href="/VerPsicologo">Ver Psicologos</a></li>
        </ul>
        <ul id="reportes" class="dropdown-content">
            <li><a href="/pdfEvento">Reporte Eventos</a></li>
            <li class="divider"></li>
            <li><a href="/pdfUsuario">Reporte Usuarios</a></li>
        </ul>
        <nav>
            <div class="nav-wrapper  light-blue darken-1">
                <a href=""><img src="imagenes/logo3.png" alt="logo" style="width: 70px; height: 70px;"></a>
                <a href="!#" class="brand-logo">Expresando</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="/evento">Eventos</a></li>
                <li><a href="/citasDoc">Citas</a></li>
                <!-- Dropdown Trigger -->
                @if(Auth::user()==null)
                <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Cuenta<i class="material-icons right">arrow_drop_down</i></a></li>
                @else
                    @if(Auth::user()->rol=='psicologo')
                    <li><a class="dropdown-trigger" href="#!" data-target="dropdown2">{{Auth::user()->email}}<i class="material-icons right">arrow_drop_down</i></a></li>
                    @endif
                @endif
            </ul>
            </div>
        </nav>
        <ul id="slide-out" class="sidenav">
            <li>
                <div class="user-view">
                    <div class="background">
                        <img src="imagenes/fondo-perfil.jpg">
                    </div>
                    <a href="#user"><img class="circle" src="imagenes/perfil.jpg"></a>
                    <a href="#name"><span class="black-text name">Susana</span></a>
                    <a href="#email"><span class="black-text email">{{Auth::user()->email}}</span></a>
                </div>
            </li>
            <li><a href="/administrador"><i class="material-icons">add_circle</i>Agregar Paciente</a></li>
            <li>
                <a class="dropdown-trigger" href="#!" data-target="dropdown4"><i class="material-icons">contacts</i>Psicologos<i class="material-icons right">arrow_drop_down</i></a>
            </li>
            <li>
                <a class="dropdown-trigger" href="#!" data-target="dropdown3"><i class="material-icons">event</i>Eventos<i class="material-icons right">arrow_drop_down</i></a>
            </li>
            <li><a href="/citasDoc"><i class="material-icons">access_alarm</i>Citas</a></li>
            <li><a href="/expediente"><i class="material-icons">create_new_folder</i>Agregar Expediente</a></li>
            <li>
                <a class="dropdown-trigger" href="#!" data-target="reportes"><i class="material-icons">picture_as_pdf</i>Reportes<i class="material-icons right">arrow_drop_down</i></a>
            </li>
        </ul>
        <div class="row" style="margin-top:10px; margin-left:10px">
            <a href="#" data-target="slide-out" class="sidenav-trigger btn-floating btn-large pulse pink accent-3"><i class="material-icons">menu</i></a>
        </div>
        <main rol="main">
            @if(Request::is('administrador'))
            <div class="container">
                <form method="POST" action="{{url('administrador/add')}}">
                    {{ csrf_field() }}
                    <div class="center">
                        <h3>Agrega un Paciente</h3>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <select name="paciente" required>
                                <option value="" disabled selected>Seleccionar</option>
                                @if ($pacientes != null)
                                    @foreach ($pacientes as $pa)
                                        <option value="{{ $pa->id}}">{{$pa->nombre.' '.$pa->a_paterno.' '.$pa->a_materno}} </option>
                                    @endforeach
                                @endif
                            </select>
                            <label>Seleccionar a un paciente</label>
                        </div>
                        <div class="col s4" style="margin-left:25px; margin-top:15px">
                            <button class="btn waves-effect waves-light" type="submit" name="action">Agregar<i class="material-icons right">add_circle</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="center">
                <h2>Pacientes</h2>
            </div>
            <table class="striped centered responsive-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Edad</th>
                        <th>Expedientes</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($registrados) > 0)
                     @foreach($registrados as $reg)
                        <form action="{{url('expediente/ver')}}" method="post">
                        {!! csrf_field() !!}
                        <tr>
                            <input type="hidden" name="idpa" value="{{$reg->id}}">
                            <td>{{$reg->nombre}}</td>
                            <td>{{$reg->a_paterno.' '. $reg->a_materno}}</td>
                            <td>{{$reg->edad}}</td>
                            <td>
                                <button class="btn waves-effect blue accent-2" type="submit" name="action">Ver
                                <i class="material-icons right">folder_shared</i>
                                </button>
                            </td>
                        </form>    
                            <td>
                                <button class="btn waves-effect red" onclick="borrar({{$reg->id}})">borrar
                                <i class="material-icons right">highlight_off</i>
                                </button>
                            </td>
                       
                     @endforeach    
                    @endif
                </tbody>
            </table>
            <!-- Modal Structure -->
            <div id="modal1" class="modal">
                <form action="{{url('paciente/eliminar')}}" method="post">
                    {!! csrf_field() !!}
                    <div class="modal-content">
                        <input type="hidden"  id="idpac" name="idpa" value="">
                        <h4>Eliminar Paciente</h4>
                        <p>Esta acción eliminara todo registro del paciente (Datos Personales,Correo y Contraseña, Expedientes).</p>
                        <p><b>¿Desea Continuar?</b></p>
                    </div>
                    <div class="modal-footer">
                        <button class="waves-effect waves-green btn-flat" type="submit" name="action">Aceptar</button>
                        <a href="#!" class="modal-close waves-effect waves-green btn-flat">cancelar</a>
                    </div>
                </form>
            </div>
            @endif
            @yield('contenido')
        <main>    
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script type="text/javascript" src="fullcalendar/lib/moment.min.js"></script>
        <script type="text/javascript" src="fullcalendar/fullcalendar.min.js"></script>
        <script type="text/javascript" src="fullcalendar/locale/es.js"></script>
        <script>
            $(function(){
              M.AutoInit();
                var msj = '<?php echo(session()->has("msjadd")); ?> ';
                if(msj  == true ){
                M.toast({html: 'paciente asignado correctamente!'});
                }
                var msjadderror = '<?php echo(session()->has("msjadderror")); ?> ';
                if(msjadderror  == true ){
                M.toast({html: 'error al asignar paciente!'});
                }
                var msj2 = '<?php echo(session()->has("msjdelete")); ?> ';
                if(msj2  == true ){
                    M.toast({html: 'paciente borrado correctamente!'});
                }   
                var msjdeletefail = '<?php echo(session()->has("msjdeletefail")); ?> ';
                if(msjdeletefail  == true ){
                    M.toast({html: 'Cancele las citas antes de eliminar!'});
                }         
            }); // end of document ready
            function borrar(id){
                $('#idpac').val(id);
                $('#modal1').modal('open');
            }
          </script>
        @yield('script')
    
    </body>
</html>
