<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Expresando</title>

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
            <li><a href="/perfil">perfil</a></li>
            <li class="divider"></li>
            <li><a href="/logout">Cerrar Sesion</a></li>
        </ul>
        <nav>
            <div class="nav-wrapper light-blue darken-1 ">
            <a href=""><img src="imagenes/logo3.png" alt="logo" style="width: 70px; height: 70px;"></a>
            <a href="!#" class="brand-logo">Expresando</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="/evento">Eventos</a></li>
                @if (Auth::user() != null && Auth::user()->rol=='paciente')
                    <li><a href="/citas">Citas</a></li>
                @endif
                <!-- Dropdown Trigger -->
                @if(Auth::user()==null)
                <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Cuenta<i class="material-icons right">arrow_drop_down</i></a></li>
                @else
                    @if(Auth::user()->rol=='psicologo')
                    <li><a class="dropdown-trigger" href="#!" data-target="dropdown2">{{Auth::user()->email}}<i class="material-icons right">arrow_drop_down</i></a></li>
                    @else
                        @if(Auth::user()->rol=='paciente')
                        <li><a class="dropdown-trigger" href="#!" data-target="dropdown3">{{Auth::user()->email}}<i class="material-icons right">arrow_drop_down</i></a></li>
                        @endif
                    @endif
                @endif
            </ul>
            </div>
        </nav>
        <main rol="main">
            @if(Request::is('/') || Request::is('home'))
                @if ($nuevo == true)
                <div class="row">
                    <div class="col s12 m6">
                      <div class="card blue-grey darken-1">
                        <div class="card-content white-text">
                          <span class="card-title">Usuario Nuevo</span>
                          <p>Hemos detectado que eres una usuario nuevo, por favor termina tu registro para continuar utilizando el sistema.</p>
                        </div>
                        <div class="card-action">
                          <a href="/perfil">Aceptar</a>
                        </div>
                      </div>
                    </div>
                  </div>
                @endif  
                <div id="index-banner" class="parallax-container">
                    <div class="section no-pad-bot">
                        <div class="container">
                            <br><br>
                            <h1 class="header center blue-text text-lighten-2">Expresando</h1>
                            <div class="row center">
                                <h5 class="header col s12 light">A modern responsive front-end framework based on Material Design</h5>
                            </div>
                            @if (Auth::user() == null)
                            <div class="row center">
                                <a href="http://materializecss.com/getting-started.html" id="download-button" class="btn-large waves-effect waves-light teal lighten-1">Regisrate</a>
                            </div>
                            @else
                            <div class="row center">
                                <a href="http://materializecss.com/getting-started.html" id="download-button" class="btn-large waves-effect waves-light teal lighten-1">Perfil</a>
                            </div>
                            @endif
                            <br><br>
                        </div>
                    </div>
                    <div class="parallax"><img src="imagenes/fondo3.jpg" alt="fondo1"></div>
                </div>

                <div class="container">
                    <div class="section">
                        <!--   Icon Section   -->
                        <div class="row">
                            <div class="col s12 m4">
                                <div class="icon-block">
                                    <h2 class="center brown-text"><i class="material-icons">flash_on</i></h2>
                                    <h5 class="center">Speeds up development</h5>
                                    <p class="light">We did most of the heavy lifting for you to provide a default stylings that incorporate our custom components. Additionally, we refined animations and transitions to provide a smoother experience for developers.</p>
                                </div>
                            </div>
                            <div class="col s12 m4">
                                <div class="icon-block">
                                    <h2 class="center brown-text"><i class="material-icons">group</i></h2>
                                    <h5 class="center">User Experience Focused</h5>
                                    <p class="light">By utilizing elements and principles of Material Design, we were able to create a framework that incorporates components and animations that provide more feedback to users. Additionally, a single underlying responsive system across all platforms allow for a more unified user experience.</p>
                                </div>
                            </div>

                            <div class="col s12 m4">
                                <div class="icon-block">
                                    <h2 class="center brown-text"><i class="material-icons">settings</i></h2>
                                    <h5 class="center">Easy to work with</h5>
                                    <p class="light">We have provided detailed documentation as well as specific code examples to help new users get started. We are also always open to feedback and can answer any questions a user may have about Materialize.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="parallax-container valign-wrapper">
                    <div class="section no-pad-bot">
                        <div class="container">
                            <div class="row center">
                                <h5 class="header col s12 light">A modern responsive front-end framework based on Material Design</h5>
                            </div>
                        </div>
                    </div>
                    <div class="parallax"><img src="imagenes/fondo1.jpg" alt="fondo"></div>
                </div>

                <div class="container">
                    <div class="section">
                        <div class="row">
                            <div class="col s12 center">
                                <h3><i class="mdi-content-send brown-text"></i></h3>
                                <h4>Contact Us</h4>
                                <p class="left-align light">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque id nunc nec volutpat. Etiam pellentesque tristique arcu, non consequat magna fermentum ac. Cras ut ultricies eros. Maecenas eros justo, ullamcorper a sapien id, viverra ultrices eros. Morbi sem neque, posuere et pretium eget, bibendum sollicitudin lacus. Aliquam eleifend sollicitudin diam, eu mattis nisl maximus sed. Nulla imperdiet semper molestie. Morbi massa odio, condimentum sed ipsum ac, gravida ultrices erat. Nullam eget dignissim mauris, non tristique erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="parallax-container valign-wrapper">
                    <div class="section no-pad-bot">
                        <div class="container">
                            <div class="row center">
                                <h5 class="header col s12 light">A modern responsive front-end framework based on Material Design</h5>
                            </div>
                        </div>
                    </div>
                    <div class="parallax"><img src="imagenes/fondo2.jpg" alt="fondo"></div>
                </div>

                <footer class="page-footer teal">
                    <div class="container">
                        <div class="row">
                            <div class="col l6 s12">
                                <h5 class="white-text">Company Bio</h5>
                                <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's our full time job. Any amount would help support and continue development on this project and is greatly appreciated.</p>
                            </div>
                            <div class="col l3 s12">
                                <h5 class="white-text">Settings</h5>
                                <ul>
                                    <li><a class="white-text" href="#!">Link 1</a></li>
                                    <li><a class="white-text" href="#!">Link 2</a></li>
                                    <li><a class="white-text" href="#!">Link 3</a></li>
                                    <li><a class="white-text" href="#!">Link 4</a></li>
                                </ul>
                            </div>
                            <div class="col l3 s12">
                                <h5 class="white-text">Connect</h5>
                                <ul>
                                    <li><a class="white-text" href="#!">Link 1</a></li>
                                    <li><a class="white-text" href="#!">Link 2</a></li>
                                    <li><a class="white-text" href="#!">Link 3</a></li>
                                    <li><a class="white-text" href="#!">Link 4</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="footer-copyright">
                        <div class="container">
                        Made by <a class="brown-text text-lighten-3" href="http://materializecss.com">Materialize</a>
                        </div>
                    </div>
                </footer>
            @endif
            @yield('contenido')
        <main>
            <div id="nuevo" class="modal">
                <div class="modal-content">
                    <h4>Paciente Nuevo</h4>
                    <p><b>Hemos detectado que eres un usuario nuevo,por favor termina tu registro y empieza a usar nuestro plataforma.</b></p>
                    <input type="hidden" id="idcita" name="idcita" value="">
                </div>
                <div class="modal-footer">
                    <a class="waves-effect waves-light btn" href="/perfil">Aceptar</a>
                </div>
            </div>    
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script type="text/javascript" src="fullcalendar/lib/moment.min.js"></script>
        <script type="text/javascript" src="fullcalendar/fullcalendar.min.js"></script>
        <script type="text/javascript" src="fullcalendar/locale/es.js"></script>
        <script>
            $(function(){

              $('.sidenav').sidenav();
              $('.parallax').parallax();  
              $(".dropdown-trigger").dropdown();         
            }); // end of document ready
          </script>
        @yield('script')
    
    </body>
</html>
