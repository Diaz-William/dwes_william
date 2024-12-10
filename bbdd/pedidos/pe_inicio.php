<?php
    // Incluir el archivo de funciones.
    include "funciones.php";
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
        <title>Menú</title>
    </head>
    <body>
        <h1>Usuario: <?php echo $_COOKIE["usuario"] ?></h1>
        <h2><a href="./pe_altaped.php">Realizar pedidos</a></h2>
        <h2><a href="./pe_consped.php">Consulta de pedidos</a></h2>
        <h2><a href="./pe_consprodstock.php">Consulta de stock por nombre</a></h2>
        <h2><a href="./pe_constock.php">Consulta de stock por línea de producto</a></h2>
        <h2><a href="./pe_topprod.php">Consulta de unidades vendidas</a></h2>
        <h2><a href="./pe_conspago.php">Consulta de pagos realizados</a></h2>
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