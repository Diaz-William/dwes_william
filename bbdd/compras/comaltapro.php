<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="William Diaz">
        <title>P.3.2.2</title>
    </head>
    <body>
        <h1>Alta Producto</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="nombre">Nombre Producto:</label>
            <input name="nombre" type="text">
            <br><br>
            <label for="precio">Precio Producto:</label>
            <input name="precio" type="text">
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
        imprimirSeleccionCategoria($conn);
        cerrarFormulario();
        cerrarConexion($conn);

        // Comprobar si se han enviado los datos del formulario por el método POST.
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["nombre"]) || empty($_POST["precio"]) || empty($_POST["categoria"])) {
                trigger_error("Tiene que introducir el nombre del producto, el precio del producto y la categoría.");
                cerrarConexion($conn);
            }else {
                $nombre = strtoupper(test_input($_POST["nombre"]));
                $precio = floatval(test_input($_POST["precio"]));
                $categoria = test_input($_POST["categoria"]);
                
                $conn = realizarConexion("comprasweb","localhost","root","rootroot");
                insertarProducto($conn, $nombre, $precio, $categoria);
                cerrarConexion($conn);
            }
        }
    ?>
</html>