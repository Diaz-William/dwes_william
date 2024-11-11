<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="William Diaz">
        <title>P.3.2</title>
    </head>
    <body>
        <h1>Alta Empleado</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="dni">DNI Empleado:</label>
            <input name="dni" type="text">
            <br><br>
            <label for="nombre">Nombre Empleado:</label>
            <input name="nombre" type="text">
            <br><br>
            <label for="apellidos">Apellidos Empleado:</label>
            <input name="apellidos" type="text">
            <br><br>
            <label for="salario">Salario Empleado:</label>
            <input name="salario" type="text">
            <br><br>
            <label for="fecha">Fecha de Nacimiento Empleado:</label>
            <input name="fecha" type="text">
            
    </body>
    <?php
        // Incluir el archivo "funciones_dados.php".
        include "funciones_bbdd.php";
        // Incluir el archivo "errores_sistema.php".
        include "errores_sistema.php";
        // Establecer la función "error_function" para el manejo de errores.
        set_error_handler("error_function");

        $conn = realizarConexion("empleadosmn","localhost","root","rootroot");
        echo "<br><br>";
        imprimirSeleccionDepartamento($conn);
        cerrarFormulario();
        cerrarConexion($conn);

        // Comprobar si se han enviado los datos del formulario por el método POST.
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["dni"]) || empty($_POST["nombre"]) || empty($_POST["dpto"])) {
                trigger_error("Tiene que introducir el dni del empleado, el nombre del empleado y el departamento.");
                cerrarConexion($conn);
            }else {
                $dni = strtoupper(test_input($_POST["dni"]));
                $nombre = strtoupper(test_input($_POST["nombre"]));
                $apellidos = empty($_POST["apellidos"]) ? null : strtoupper(test_input($_POST["apellidos"]));
                $salario = empty($_POST["salario"]) ? null : intval(test_input($_POST["salario"]));
                $fecha = empty($_POST["fecha"]) ? null : date("Y-m-d", strtotime(test_input($_POST["fecha"])));
                $dpto = test_input($_POST["dpto"]);
                
                $conn = realizarConexion("empleadosmn","localhost","root","rootroot");
                insertarEmpleado($conn, $dni, $nombre, $apellidos, $salario, $fecha, $dpto);
                cerrarConexion($conn);
            }
        }
    ?>
</html>