<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="William Diaz">
        <title>P.3.2.1</title>
    </head>
    <body>
        <h1>Alta Categoría</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="nomCategoria">Nombre Categoría:</label>
            <input name="nomCategoria" type="text">
            <br><br>
            <input type="submit" value="Enviar">
        </form>
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
            if (empty($_POST["nomCategoria"])) {
                // Mostrar un error si no se introduce el nombre de la categoría.
                trigger_error("Tiene que introducir un nombre de categoría");
            }else {
                $nombre = strtoupper(test_input($_POST["nomCategoria"]));
                $conn = realizarConexion("comprasweb","localhost","root","rootroot");
                if (comprobarExistenciaCategoria($conn, $nombre)) {
                    // Mostrar un error si ya existe una categoría con el nombre introducido.
                    trigger_error("Ya existe una categoría con el nombre $nombre");
                    cerrarConexion($conn);
                }else {
                    insertarCategoria($conn, $nombre);
                    cerrarConexion($conn);
                }
            }
        }
    ?>
</html>