<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="William Diaz">
        <title>P.3.2.4</title>
    </head>
    <body>
        <h1>Aprovisionar Productos</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="cantidad">Cantidad:</label>
            <input name="cantidad" type="text">
            <br><br>
    </body>
    <?php
        // Incluir el archivo "funciones_dados_compras.php".
        include "funciones_bbdd_compras.php";
        // Incluir el archivo "errores_sistema_compras.php".
        include "errores_sistema_compras.php";
        // Establecer la función "error_function" para el manejo de errores.
        set_error_handler("error_function");

        $conn = realizarConexion("comprasweb","localhost","root","rootroot");
        imprimirSeleccionProductos($conn);
        imprimirSeleccionAlmacenes($conn);
        cerrarFormulario();
        cerrarConexion($conn);

        // Comprobar si se han enviado los datos del formulario por el método POST.
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["cantidad"]) || empty($_POST["producto"]) || empty($_POST["almacen"])) {
                trigger_error("Tiene que introducir la cantidad, el producto y el almacen.");
                cerrarConexion($conn);
            }else {
                $cantidad = intval(test_input($_POST["cantidad"]));
                $id_producto = test_input($_POST["producto"]);
                $num_almacen = test_input($_POST["almacen"]);
                
                $conn = realizarConexion("comprasweb","localhost","root","rootroot");
                insertarAlmacena($conn, $num_almacen, $id_producto, $cantidad);
                cerrarConexion($conn);
            }
        }
    ?>
</html>