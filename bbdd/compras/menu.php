<?php session_start() ?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="William Diaz">
        <title>Menú</title>
    </head>
    <body>
        <h1>Usuario: <?php echo $_SESSION["usuario"] ?></h1>
        <h2><a href="./comprocli.php">Compras de productos</a></h2>
        <h2><a href="./comconscli.php">Consulta de compras</a></h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <br><br>
            <input type="submit" name="cerrar" id="cerrar" value="Cerrar Sesión">
        </form>
        <?php
            // Comprobar si se han enviado los datos del formulario por el método POST.
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                cerrarSesion();
            }
        ?>
    </body>
</html>