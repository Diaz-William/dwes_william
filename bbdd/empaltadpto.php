<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="William Diaz">
        <title>P.3.1</title>
    </head>
    <body>
        <h1>Alta Departamento</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="nomDpto">Nombre Departamento:</label>
            <input name="nomDpto" type="text">
        </form>
    </body>
    <?php
        // Incluir el archivo "funciones_dados.php".
        include "funciones_bbdd.php";
        // Incluir el archivo "errores_sistema.php".
        include "errores_sistema.php";
        // Establecer la función "error_function" para el manejo de errores.
        set_error_handler("error_function");

        // Comprobar si se han enviado los datos del formulario por el método POST.
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["nomDpto"])) {
                trigger_error("Tiene que introducir un nombre de departamento");
            }else {
                $conn = realizarConexion("empleadosmn","localhost","root","rootroot");
                insertarDepartamneto($conn, $nombre);
            }
        }
    ?>
</html>