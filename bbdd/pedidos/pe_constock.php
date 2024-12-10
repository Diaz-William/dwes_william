<?php
    // Incluir el archivo de funciones.
    include "funciones_pe_constock.php";
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
        <title>Consultar Stock Línea Producto</title>
    </head>
    <body>
        <h1>Usuario: <?php echo $_COOKIE["usuario"] ?></h1>
        <h2>Consultar Stock Línea Producto</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <?php imprimirSeleccionLineaProducto(); ?>
            <br><br>
            <input type="submit" name="consultar" id="consultar" value="Consultar">
            <br><br>
            <input type="submit" name="cerrar" id="cerrar" value="Cerrar Sesión">
        </form>

        <?php
            // Comprobar si se han enviado los datos del formulario por el método POST.
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST["consultar"])) {
                    if (empty($_POST["producto"])) {
                        trigger_error("Tiene que seleccionar la línea de producto.");
                    } else {
                        $productLine = test_input($_POST["productLine"]);
                        consultarStockProducto($productLine);
                    }
                }else if (isset($_POST["cerrar"])) {
                    cerrarSesionCookies();
                }
            }
        ?>
    </body>
</html>