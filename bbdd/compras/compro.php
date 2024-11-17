<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="William Diaz">
        <title>P.3.2.9</title>
    </head>
    <body>
        <h1>Comprar Productos</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="unidades">Unidades:</label>
            <input name="unidades" type="text">
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
        imprimirSeleccionProductosDisponibles($conn);
        imprimirSeleccionNif($conn);
        cerrarFormulario();
        cerrarConexion($conn);

        // Comprobar si se han enviado los datos del formulario por el método POST.
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["nif"]) || empty($_POST["producto"]) || empty($_POST["unidades"])) {
                trigger_error("Tiene que seleccionar las unidades del producto, el producto y el nif.");
            }else if (!preg_match('/^\d{8}[a-z]$/i', $nif)) {
                trigger_error("El nif tiene un formato incorrecto (Ej: 12345678Z).");
            }else {
                $nif = strtoupper(test_input($_POST["nif"]));
                $datos = explode("-", test_input($_POST["producto"]));
                $id_producto = $datos[0];
                $num_almacen = $datos[1];
                $unidades = test_input($_POST["unidades"]);
                
                $conn = realizarConexion("comprasweb","localhost","root","rootroot");
                comprarProducto($conn, $id_producto, $num_almacen, $nif, $unidades);
                cerrarConexion($conn);
            }
        }
    ?>
</html>