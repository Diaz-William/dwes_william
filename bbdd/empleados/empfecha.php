<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="William Diaz">
        <title>P.3.7</title>
    </head>
    <body>
        <h1>Lista Empleados por Fecha</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="fecha">Fecha:</label>
            <input type="text" name="fecha" id="fecha">
            <br><br>
            <input type="submit" value="Enviar">
        </form>
    </body>
    <?php
        // Incluir el archivo "funciones_dados.php".
        include "funciones_bbdd.php";
        // Incluir el archivo "errores_sistema.php".
        include "errores_sistema.php";
        // Establecer la función "error_function" para el manejo de errores.
        set_error_handler("error_function");

        // Comprobar si se han enviado los datos del formulario por el método POST.
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["fecha"])) {
                trigger_error("Tiene que introducir una fecha.");
            }else {
                $fecha = date("Y-m-d", strtotime(test_input($_POST["fecha"])));
                $conn = realizarConexion("empleadosmn","localhost","root","rootroot");
                empleadosFecha($conn, $fecha);
                cerrarConexion($conn);
            }
        }
    ?>
</html>