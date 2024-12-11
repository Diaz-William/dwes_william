<?php
    ob_start();
    // Incluir el archivo de funciones.
    include "funciones_pe_altaped.php";
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
        <title>Realizar pedidos</title>
    </head>
    <body>
        <a href="./pe_inicio.php">Inicio</a>
        <h1>Usuario: <?php echo $_COOKIE["usuario"]; ?></h1>
        <h2>Comprar Productos</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="unidades">Unidades:</label>
            <input name="unidades" type="text">
            <br><br>
            <?php imprimirSeleccionProductosDisponibles(); ?>
            <br><br>
            <input type="submit" name="enviar" id="enviar" value="Añadir">
            <input type="submit" name="comprar" id="comprar" value="Comprar">
            <br><br>
            <input type="submit" name="cerrar" id="cerrar" value="Cerrar Sesión">
			<?php imprimirCestaCookies(); ?>
        </form>

        <?php
            // Comprobar si se han enviado los datos del formulario por el método POST.
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST["enviar"])) {
                    if (empty($_POST["producto"]) || empty($_POST["unidades"])) {
                        trigger_error("Tiene que seleccionar las unidades del producto, el producto y el número de pago.");
                    }else {
                        list($productCode, $productName, floatval($priceEach)) = explode("#", test_input($_POST["producto"]));
                        $unidades = intval(test_input($_POST["unidades"]));
                        guardarProductoCookies($productCode, $productName, $priceEach, $unidades);
                        header("Refresh:0");
                    }
                }else if (isset($_POST["comprar"])) {
                    if (isset($_COOKIE["cesta"])) {
                        header("Location: ./pe_comprar.php");
                    }else {
                        trigger_error("Tiene que añadir productos a la cesta");
                    }
                }else if (isset($_POST["cerrar"])) {
                    cerrarSesionCookies();
                }
            }
            ob_end_flush();
        ?>
    </body>
</html>