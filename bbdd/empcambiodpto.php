<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="William Diaz">
        <title>P.3.3</title>
    </head>
    <body>
        <h1>Cambiar Departamento de Empleado</h1>
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
        imprimirSeleccionDni($conn);
        cerrarFormulario();
        cerrarConexion($conn);

        // Comprobar si se han enviado los datos del formulario por el método POST.
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["dni"]) || empty($_POST["dpto"])) {
                trigger_error("Tiene que seleccionar el dni del empleado y el nuevo departamento.");
                cerrarConexion($conn);
            }else {
                $dni = test_input($_POST["dni"]);
                $dpto = test_input($_POST["dpto"]);
                $conn = realizarConexion("empleadosmn","localhost","root","rootroot");
                if (comprobarCambioDpto($conn, $dni, $dpto)) {
                    trigger_error("El empleado con el dni $dni no se puede volver a cambiar de departamento hoy.");
                    cerrarConexion($conn);
                }else {
                    actualizarEmple_Dpto($conn, $dni, $dpto);
                    cerrarConexion($conn);
                    echo "<p>Se ha cambiado al empledo $nombre con el dni $dni al departamento $dpto</p>";
                }
            }
        }
    ?>
</html>