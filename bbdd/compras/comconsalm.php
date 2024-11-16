<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="William Diaz">
        <title>P.3.2.6</title>
    </head>
    <body>
        <h1>Consultar Stock de Almacen</h1>
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
        imprimirSeleccionAlmacenes($conn);
        cerrarFormulario();
        cerrarConexion($conn);

        // Comprobar si se han enviado los datos del formulario por el método POST.
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["almacen"])) {
                trigger_error("Tiene que seleccionar el almacen.");
                cerrarConexion($conn);
            }else {
                $num_almacen = test_input($_POST["almacen"]);
                
                $conn = realizarConexion("comprasweb","localhost","root","rootroot");
                visualizarStockAlmacen($conn, $num_almacen);
                cerrarConexion($conn);
            }
        }
    ?>
</html>