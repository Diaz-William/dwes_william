<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="William Diaz">
        <title>P.3.6</title>
    </head>
    <body>
        <h1>Actualizar Salario Empleados</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="porcentaje">Número del porcentaje (+/-)</label>
            <input type="text" name="porcentaje" id="porcentaje">
            <br><br>
    </body>
    <?php
        // Incluir el archivo "funciones_dados.php".
        include "funciones_bbdd.php";
        // Incluir el archivo "errores_sistema.php".
        include "errores_sistema.php";
        // Establecer la función "error_function" para el manejo de errores.
        set_error_handler("error_function");

        $conn = realizarConexion("empleadosmn","localhost","root","rootroot");
        imprimirSeleccionDni($conn);
        cerrarFormulario();
        cerrarConexion($conn);

        // Comprobar si se han enviado los datos del formulario por el método POST.
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["dni"]) || empty($_POST["porcentaje"])) {
                trigger_error("Tiene que seleccionar un dni.");
                cerrarConexion($conn);
            }else {
                $dni = test_input($_POST["dni"]);
                $porcentaje = floatval(test_input($_POST["porcentaje"])) / 100;
                $conn = realizarConexion("empleadosmn","localhost","root","rootroot");
                actualizarSalarioEmpleado($conn, $dni, $porcentaje);
                cerrarConexion($conn);
            }
        }
    ?>
</html>