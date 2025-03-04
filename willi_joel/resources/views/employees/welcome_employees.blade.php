<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido al Portal del Empleado</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Portal del Empleado</h1> 

        <div class="card border-success mb-3 mx-auto" style="max-width: 30rem;">
            <div class="card-header">Menú Empleado - OPERACIONES</div>
            <div class="card-body">
                <b>Bienvenido/a: </b> {{ Cookie::get('NAME') }}<br><br>
                <b>Identificador Empleado: </b> {{ Cookie::get('USERPASS') }}<br><br>

                <!-- Botones del menú -->
                
                <button onclick="window.location.href=''" class="btn btn-warning disabled">Mi nómina</button>
                <button onclick="window.location.href=''" class="btn btn-warning disabled">Historial laboral</button><br><br>

                <a href="{{ route('logout') }}" class="btn btn-danger">Cerrar Sesión</a>
            </div>
        </div>
    </div>
</body>
</html>
