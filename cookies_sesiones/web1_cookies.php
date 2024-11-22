<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="William Diaz">
        <title>Web1</title>
    </head>
    <body>
        <h1>Web1 <?php echo $_COOKIE["usuario"]; ?></h1>
        <h3><a href="./web2_cookies.php">Web2</a></h3>
        <h3><a href="./web3_cookies.php">Web3</a></h3>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="submit" name="cerrarSesion" id="cerrarSesion" value="Cerrar Sesión">
        </form>
        <?php
            // Incluir el archivo de funciones.
            include 'funciones.php';
            // Incluir el archivo de manejo de errores.
            include 'errores.php';
            // Establecer la función "error_function" para el manejo de errores.
            set_error_handler("error_function");

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                eliminarCookies();
            }
        ?>
    </body>
</html>