<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="William Diaz">
        <title>P.3.5</title>
    </head>
    <body>
        <h1>Listar Empleados Departamento</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    </body>
    <?php
        // Incluir el archivo "funciones_dados.php".
        include "funciones_bbdd.php";
        // Incluir el archivo "errores_sistema.php".
        include "errores_sistema.php";
        // Establecer la función "error_function" para el manejo de errores.
        set_error_handler("error_function");

        $conn = realizarConexion("empleadosmn","localhost","root","rootroot");
        imprimirSeleccionDepartamento($conn);
        echo "<br><br>";
        cerrarFormulario();
        cerrarConexion($conn);

        // Comprobar si se han enviado los datos del formulario por el método POST.
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["dpto"])) {
                trigger_error("Tiene que seleccionar un departamento.");
                cerrarConexion($conn);
            }else {
                $dpto = test_input($_POST["dpto"]);
                $conn = realizarConexion("empleadosmn","localhost","root","rootroot");
                listarEmpleadosAntiguosDepartamento($conn, $dpto);
                cerrarConexion($conn);
            }
        }
    ?>
</html>