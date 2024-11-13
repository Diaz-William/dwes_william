<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="William Diaz">
        <title>P.3.2.3</title>
    </head>
    <body>
        <h1>Alta Almacen</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="localidad">Localidad:</label>
            <input name="localidad" type="text">
            <br><br>
    </body>
    <?php
        // Incluir el archivo "funciones_dados_compras.php".
        include "funciones_bbdd_compras.php";
        // Incluir el archivo "errores_sistema_compras.php".
        include "errores_sistema_compras.php";
        // Establecer la función "error_function" para el manejo de errores.
        set_error_handler("error_function");

        // Comprobar si se han enviado los datos del formulario por el método POST.
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["localidad"])) {
                trigger_error("Tiene que introducir el nombre de la localidad.");
                cerrarConexion($conn);
            }else {
                $localidad = strtoupper(test_input($_POST["localidad"]));
                
                $conn = realizarConexion("comprasweb","localhost","root","rootroot");
                insertarAlmacen($conn, $localidad);
                cerrarConexion($conn);
            }
        }
    ?>
</html>