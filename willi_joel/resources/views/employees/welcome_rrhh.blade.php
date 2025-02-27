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
        <h1 class="text-center">Portal de Recursos Humanos</h1> 

        <div class="card border-success mb-3 mx-auto" style="max-width: 30rem;">
            <div class="card-header">Menú RRHH - OPERACIONES</div>
            <div class="card-body">
                <b>Bienvenido/a: </b> {{ Cookie::get('NAME') }}<br><br>
                <b>Identificador Empleado: </b> {{ Cookie::get('USERPASS') }}<br><br>

                <!-- Botones del menú -->
                <?php
                
                /*<!-- <button onclick="window.location.href='{{ route('altaEmpleado') }}'" class="btn btn-warning disabled">Alta de empleado</button>
                <button onclick="window.location.href='{{ route('altaMasiva') }}'" class="btn btn-warning disabled">Alta masiva de empleados</button><br><br>
                <button onclick="window.location.href='{{ route('modificarSalario') }}'" class="btn btn-warning disabled">Modificar salario</button>
                <button onclick="window.location.href='{{ route('vidaLaboral') }}'" class="btn btn-warning disabled">Vida laboral</button><br><br>
                <button onclick="window.location.href='{{ route('infoDepartamento') }}'" class="btn btn-warning disabled">Info del departamento</button>
                <button onclick="window.location.href='{{ route('cambioDepartamento') }}'" class="btn btn-warning disabled">Cambio de departamento</button><br><br>
                <button onclick="window.location.href='{{ route('cambioJefe') }}'" class="btn btn-warning disabled">Cambio de jefe de departamento</button>
                <button onclick="window.location.href='{{ route('bajaEmpleado') }}'" class="btn btn-warning disabled">Baja de empleado</button> -->*/
                ?>
                
                <button onclick="window.location.href=''" class="btn btn-warning disabled">Alta de empleado</button>
                <button onclick="window.location.href=''" class="btn btn-warning disabled">Alta masiva de empleados</button><br><br>
                <button onclick="window.location.href=''" class="btn btn-warning disabled">Modificar salario</button>
                <button onclick="window.location.href=''" class="btn btn-warning disabled">Vida laboral</button><br><br>
                <button onclick="window.location.href=''" class="btn btn-warning disabled">Info del departamento</button>
                <button onclick="window.location.href=''" class="btn btn-warning disabled">Cambio de departamento</button><br><br>
                <button onclick="window.location.href=''" class="btn btn-warning disabled">Cambio de jefe de departamento</button>
                <button onclick="window.location.href=''" class="btn btn-warning disabled">Baja de empleado</button>
                
                <hr>
                <?php
                /*<!-- <button onclick="window.location.href='{{ route('nomina') }}'" class="btn btn-warning disabled">Mi nómina</button>
                <button onclick="window.location.href='{{ route('historialLaboral') }}'" class="btn btn-warning disabled">Historial laboral</button><br><br> -->*/
                ?>
                
                <button onclick="window.location.href=''" class="btn btn-warning disabled">Mi nómina</button>
                <button onclick="window.location.href=''" class="btn btn-warning disabled">Historial laboral</button><br><br>

                <a href="{{ route('logout') }}" class="btn btn-danger">Cerrar Sesión</a>
            </div>
        </div>
    </div>
</body>
</html>
