<?php
    // Incluir el archivo "funciones_dados_compras.php".
    include "funciones_bbdd_compras.php";
    // Incluir el archivo "errores_sistema_compras.php".
    include "errores_sistema_compras.php";
    // Establecer la función "error_function" para el manejo de errores.
    set_error_handler("error_function");
    session_start();

    if (!isset($_SESSION["usuario"])) {
        cerrarSesion();
        header("Location: ./comlogincli.php");
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
        <h1>Usuario: <?php echo $_SESSION["usuario"] ?></h1>
        <h2>Comprar Productos</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="unidades">Unidades:</label>
            <input name="unidades" type="text">
            <br><br>
            <?php imprimirSeleccionProductosDisponibles(); ?>
            <br><br>
            <input type="submit" name="enviar" id="enviar" value="Añadir">
            <input type="button" name="comprar" id="comprar" value="Comprar">
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
                        guardarProducto($id_producto, $unidades);
                        var_dump($_SESSION["cesta"]);
                        imprimirCesta();
                    }
                } elseif (isset($_POST["comprar"])) {
                    comprarProductoSesion();
                }
            }
        ?>
    </body>
</html>