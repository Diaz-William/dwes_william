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
            <br><br>
            <input type="submit" value="Insetar">
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
                $nombre = strtoupper(test_input($_POST["nomDpto"]));
                $conn = realizarConexion("empleadosmn","localhost","root","rootroot");
                if (comprobarExistenciaDepartamento($conn, $nombre)) {
                    trigger_error("Ya existe un departamento $nombre");
                    cerrarConexion($conn);
                }else {
                    insertarDepartamneto($conn, $nombre);
                    cerrarConexion($conn);
                }
            }
        }
    ?>
</html>