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
            <label for="numPago">Número de pago:</label>
            <input type="text" name="numPago" id="numPago" placeholder="AA99999">
            <br><br>
            <input type="submit" name="comprar" id="comprar" value="Comprar">
            <br><br>
            <input type="submit" name="cerrar" id="cerrar" value="Cerrar Sesión">
			<?php imprimirCestaCookies(); ?>
        </form>

        <?php
            // Comprobar si se han enviado los datos del formulario por el método POST.
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST["comprar"])) {
                    if (empty($_POST["numPago"])) {
                        trigger_error("Tiene que introducir el número de pago.");
                    }else if (preg_match("/^[a-z][a-z]\d{5}$/i", test_input($_POST["numPago"])) && obtenerCheckNumber(test_input($_POST["numPago"]))) {
                        comprarProductoSesionCookies(test_input($_POST["numPago"]));
                        header("Location: ./pe_pagar.php");
                    }else {
                        trigger_error("El número de pago tiene un formato incorrecto o ya ha sido utilizado");
                    }
                }else if (isset($_POST["cerrar"])) {
                    cerrarSesionCookies();
                }
            }
            ob_end_flush();
        ?>
    </body>
</html>