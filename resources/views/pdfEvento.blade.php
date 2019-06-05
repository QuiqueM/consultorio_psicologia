<!doctype html>
<html lang="en">
  <head>
    <title>Eventos</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        .letra{
            font-size: 10px;
            text-align: justify;
        }

    </style>
</head>
  <body>
      <div class="contariner">
    <table class="table table-striped">
        <tr >
            <td class="table-primary"></td>
            <td ><img class=" " src="imagenes/logo2.png"  height="50" alt="logo"></td>
            <td><label class="">Expresando</label></td>
        </tr>
    </table>
    <h6 class="font-weight-bold text-center">Resumen mensual de las inscripciones a los eventos, destacando cual tuvo más asistencia.</h6>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>No.Asistentes</th>
            </tr>
        </thead>
        <tbody>
        @for ($i = 7; $i < 9; $i++)
            <tr>
                <td>{{$evento[$i]}}</td>
                <td>{{count($ins[$i])}}</td>
            </tr>
            
        @endfor
        </tbody>
    </table>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
