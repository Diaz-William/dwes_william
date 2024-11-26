<?php
    // Incluir el archivo "funciones_dados_compras.php".
    include "funciones_bbdd_compras.php";
    // Incluir el archivo "errores_sistema_compras.php".
    include "errores_sistema_compras.php";
    // Establecer la función "error_function" para el manejo de errores.
    set_error_handler("error_function");
    session_start();

    if (!isset($_SESSION["usuario"])) {
        cerrarSesion();
        header("Location: ./comlogincli.php");
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="William Diaz">
        <title>P.3.2.13</title>
    </head>
    <body>
        <h1>Usuario: <?php echo $_SESSION["usuario"] ?></h1>
        <h2>Consultar Compras</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="fecha_in">Fecha Inicio:</label>
            <input name="fecha_in" type="text">
            <br><br>
            <label for="fecha_fin">Fecha Fin:</label>
            <input name="fecha_fin" type="text">
            <br><br>
            <input type="submit" name="enviar" id="enviar" value="Enviar">
            <br><br>
            <input type="submit" name="cerrar" id="cerrar" value="Cerrar Sesión">
        </form>

        <?php
            // Comprobar si se han enviado los datos del formulario por el método POST.
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST["enviar"])) {
                    if (empty($_POST["fecha_in"]) || empty($_POST["fecha_fin"])) {
                        trigger_error("Tiene que introducir la fecha de inicio y la fecha de fin.");
                    }else {
                        $fecha_in = date("Y-m-d", strtotime(test_input($_POST["fecha_in"])));
                        $fecha_fin = date("Y-m-d", strtotime(test_input($_POST["fecha_fin"])));
                        visualizarComprasClienteSesion($fecha_in, $fecha_fin, $_SESSION["usuario"]);
                    }
                }else if (isset($_POST["cerrar"])) {
                    cerrarSesion();
                }
            }
        ?>
    </body>
</html>