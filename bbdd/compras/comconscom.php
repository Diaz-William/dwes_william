<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="William Diaz">
        <title>P.3.2.7</title>
    </head>
    <body>
        <h1>Aprovisionar Productos</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="fecha_in">Fecha Inicio:</label>
            <input name="fecha_in" type="text">
            <br><br>
            <label for="fecha_fin">Fecha Fin:</label>
            <input name="fecha_fin" type="text">
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
        imprimirSeleccionNif($conn);
        cerrarFormulario();
        cerrarConexion($conn);

        // Comprobar si se han enviado los datos del formulario por el método POST.
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["fecha_in"]) || empty($_POST["fecha_fin"]) || empty($_POST["nif"])) {
                trigger_error("Tiene que introducir la fecha de inicio, la fecha de fin y el nif.");
                cerrarConexion($conn);
            }else {
                $nif = test_input($_POST["nif"]);
                $fecha_in = date("Y-m-d", strtotime(test_input($_POST["fecha_in"])));
                $fecha_fin = date("Y-m-d", strtotime(test_input($_POST["fecha_fin"])));
                
                $conn = realizarConexion("comprasweb","localhost","root","rootroot");
                visualizarComprasCliente($conn, $nif, $fecha_in, $fecha_fin);
                cerrarConexion($conn);
            }
        }
    ?>
</html>