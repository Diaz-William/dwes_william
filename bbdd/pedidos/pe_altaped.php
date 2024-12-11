<?php
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
        <h1>Usuario: <?php echo $_COOKIE["usuario"] ?></h1>
        <h2>Comprar Productos</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="unidades">Unidades:</label>
            <input name="unidades" type="text">
            <br><br>
            <?php imprimirSeleccionProductosDisponibles(); ?>
            <br><br>
            <label for="numPago">Número de pago:</label>
            <input type="text" name="numPago" id="numPago" placeholder="AA99999">
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
                    if (empty($_POST["producto"]) || empty($_POST["unidades"]) || empty($_POST["numPago"])) {
                        trigger_error("Tiene que seleccionar las unidades del producto, el producto y el número de pago.");
                    }else if (preg_match("/^[a-z][a-z]\d{5}$/i", test_input($_POST["numPago"]))) {
                        $productCode = test_input($_POST["producto"]);
                        $unidades = intval(test_input($_POST["unidades"]));
                        $checkNumber = test_input($_POST["numPago"]);
                        guardarProductoCookies($productCode, $unidades);
                    }else {
                        trigger_error("El número de pago tiene un formato incorrecto");
                    }
                }else if (isset($_POST["comprar"])) {
                    comprarProductoSesionCookies();
                }else if (isset($_POST["cerrar"])) {
                    cerrarSesionCookies();
                }
                header("Refresh:0");
            }
        ?>
    </body>
</html>