<?php
    // Incluir el archivo "funciones_dados_compras.php".
    include "funciones_bbdd_compras.php";
    // Incluir el archivo "errores_sistema_compras.php".
    include "errores_sistema_compras.php";
    // Establecer la función "error_function" para el manejo de errores.
    set_error_handler("error_function");

    if (!isset($_COOKIE["usuario"]) || !isset($_COOKIE["clave"])) {
        cerrarSesionCookies();
        header("Location: ./comlogincli_cookies.php");
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="William Diaz">
        <title>P.3.2.12</title>
    </head>
    <body>
        <h1>Usuario: <?php echo $_COOKIE["usuario"] ?></h1>
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
                        trigger_error("Tiene que seleccionar las unidades del producto y el producto.");
                    } else {
                        $id_producto = test_input($_POST["producto"]);
                        $unidades = intval(test_input($_POST["unidades"]));
                        guardarProductoCookies($id_producto, $unidades);
                        header("Refresh:0");
                    }
                } else if (isset($_POST["comprar"])) {
                    comprarProductoSesionCookies();
                }else if (isset($_POST["cerrar"])) {
                    cerrarSesionCookies();
                }
            }
        ?>
    </body>
</html>