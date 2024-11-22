<?php session_start(); ?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="William Diaz">
        <title>Web1</title>
    </head>
    <body>
        <h1>Web1 <?php echo $_SESSION["usuario"]; ?></h1>
        <h3><a href="./web2_sesion.php">Web2</a></h3>
        <h3><a href="./web3_sesion.php">Web3</a></h3>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="submit" name="cerrarSesion" id="cerrarSesion" value="Cerrar Sesión">
        </form>
        <?php
            // Incluir el archivo de funciones.
            include 'funciones_sesion.php';
            // Incluir el archivo de manejo de errores.
            include 'errores.php';
            // Establecer la función "error_function" para el manejo de errores.
            set_error_handler("error_function");

            // Comprobar si se han enviado los datos del formulario por el método POST.
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                session_unset();
                session_destroy();
                header("Location: ./inicio_sesion.php");
            }
        ?>
    </body>
</html>