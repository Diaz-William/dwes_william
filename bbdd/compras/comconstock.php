<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="William Diaz">
        <title>P.3.2.5</title>
    </head>
    <body>
        <h1>Consultar Stock de Productos</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
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
        cerrarFormulario();
        cerrarConexion($conn);

        // Comprobar si se han enviado los datos del formulario por el método POST.
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["producto"])) {
                trigger_error("Tiene que seleccionar el producto.");
                cerrarConexion($conn);
            }else {
                $id_producto = test_input($_POST["producto"]);
                
                $conn = realizarConexion("comprasweb","localhost","root","rootroot");
                insertarAlmacena($conn, $num_almacen, $id_producto, $cantidad);
                cerrarConexion($conn);
            }
        }
    ?>
</html>