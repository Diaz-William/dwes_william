<?php
    // Incluir el archivo "funciones_dados_compras.php".
    include "funciones_bbdd_compras.php";
    // Incluir el archivo "errores_sistema_compras.php".
    include "errores_sistema_compras.php";
    // Establecer la función "error_function" para el manejo de errores.
    set_error_handler("error_function");
    session_start();

    if (!isset($_SESSION["usuario"])) {
        header("Location: ./comlogincli.php");
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="William Diaz">
        <title>P.3.2.11</title>
    </head>
    <body>
        <h1>Comprar Productos</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="unidades">Unidades:</label>
            <input name="unidades" type="text">
            <br><br>
            <?php imprimirSeleccionProductosDisponibles(); ?>
            <br><br>
            <input type="submit" name="enviar" id="enviar" value="Enviar">
        </form>
    </body>
    <?php
        // Comprobar si se han enviado los datos del formulario por el método POST.
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["producto"]) || empty($_POST["unidades"])) {
                trigger_error("Tiene que seleccionar las unidades del producto, el producto y el nif.");
            }else {
                $id_producto = test_input($_POST["producto"]);
                $unidades = intval(test_input($_POST["unidades"]));
                guardarProducto($id_producto, $unidades);

                comprarProductoSesion();
            }
        }
    ?>
</html>