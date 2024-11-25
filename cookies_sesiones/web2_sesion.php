<?php
    if (isset($_SESSION["usuario"])) {
        header("Location: ./inicio_sesion.php");
    }
    session_start();
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="William Diaz">
        <title>Web2</title>
    </head>
    <body>
        <h1>Web2 <?php echo $_SESSION["usuario"]; ?></h1>
        <h3><a href="./web1_sesion.php">Web1</a></h3>
        <h3><a href="./web3_sesion.php">Web3</a></h3>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="submit" name="cerrarSesion" id="cerrarSesion" value="Cerrar Sesión">
        </form>
        <?php
            // Incluir el archivo de funciones.
            include 'funciones.php';
            // Incluir el archivo de manejo de errores.
            include 'errores.php';
            // Establecer la función "error_function" para el manejo de errores.
            set_error_handler("error_function");

            // Comprobar si se han enviado los datos del formulario por el método POST.
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                cerrarSesion();
            }
        ?>
    </body>
</html>