<?php
    // Incluir el archivo "funciones_dados_compras.php".
    include "funciones_bbdd_compras.php";
    // Incluir el archivo "errores_sistema_compras.php".
    include "errores_sistema_compras.php";
    // Establecer la función "error_function" para el manejo de errores.
    set_error_handler("error_function");

    if (!isset($_COOKIE["usuario"])) {
        cerrarSesionCookies();
        header("Location: ./comlogincli_cookies.php");
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="William Diaz">
        <title>Menú</title>
    </head>
    <body>
        <h1>Usuario: <?php echo $_COOKIE["usuario"] ?></h1>
        <h2><a href="./comprocli_cookies.php">Compras de productos</a></h2>
        <h2><a href="./comconscli_cookies.php">Consulta de compras</a></h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <br><br>
            <input type="submit" name="cerrar" id="cerrar" value="Cerrar Sesión">
        </form>
        <?php
            // Comprobar si se han enviado los datos del formulario por el método POST.
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                cerrarSesionCookies();
            }
        ?>
    </body>
</html>