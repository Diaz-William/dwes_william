<?php
    // Incluir el archivo de funciones.
    include "funciones_pe_topprod.php";
    // Incluir el archivo de manejo de errores.
    include "errores.php";
    // Establecer la función "error_function" para el manejo de errores.
    set_error_handler("error_function");

    if (!isset($_COOKIE["usuario"])) {
        cerrarSesionCookies();
        header("Location: ./pe_login.php");
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="William Diaz">
        <title>Consulta de unidades vendidas</title>
    </head>
    <body>
        <h1>Usuario: <?php echo $_COOKIE["usuario"] ?></h1>
        <h2>Consulta de unidades vendidas</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="fecha_in">Fecha Inicio:</label>
            <input name="fecha_in" type="text" placeholder="año-mes-día">
            <br><br>
            <label for="fecha_fin">Fecha Fin:</label>
            <input name="fecha_fin" type="text" placeholder="año-mes-día">
            <br><br>
            <input type="submit" name="consultar" id="consultar" value="Consultar">
            <br><br>
            <input type="submit" name="cerrar" id="cerrar" value="Cerrar Sesión">
        </form>

        <?php
            // Comprobar si se han enviado los datos del formulario por el método POST.
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST["consultar"])) {
                    if (empty($_POST["fecha_in"]) || empty($_POST["fecha_fin"])) {
                        trigger_error("Tiene que introducir la fecha de inicio y la fecha de fin.");
                    }else {
                        $fecha_in = date("Y-m-d", strtotime(test_input($_POST["fecha_in"])));
                        $fecha_fin = date("Y-m-d", strtotime(test_input($_POST["fecha_fin"])));
                        obtenerOrdenes($fecha_in, $fecha_fin);
                    }
                }else if (isset($_POST["cerrar"])) {
                    cerrarSesionCookies();
                }
            }
        ?>
    </body>
</html>