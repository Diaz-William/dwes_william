<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="William Diaz">
        <title>P.3.2.8</title>
    </head>
    <body>
        <h1>Alta Cliente</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="nif">NIF Cliente:</label>
            <input name="nif" type="text">
            <br><br>
            <label for="nombre">Nombre Cliente:</label>
            <input name="nombre" type="text">
            <br><br>
            <label for="apellidos">Apellidos Cliente:</label>
            <input name="apellidos" type="text">
            <br><br>
            <label for="cp">Código Postal Cliente:</label>
            <input name="cp" type="text">
            <br><br>
            <label for="direccion">Dirección Cliente:</label>
            <input name="direccion" type="text">
            <br><br>
            <label for="ciudad">Ciudad Cliente:</label>
            <input name="ciudad" type="text">
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
            if (empty($_POST["nif"])) {
                trigger_error("Tiene que introducir el nif del cliente.");
            }else if (!preg_match('/^\d{8}[a-z]$/i', $nif)) {
                trigger_error("El nif tiene un formato incorrecto (Ej: 12345678Z).");
            }else {
                $nif = strtoupper(test_input($_POST["nif"]));
                $nombre = empty($_POST["apellidos"]) ? null : strtoupper(test_input($_POST["nombre"]));
                $apellidos = empty($_POST["apellidos"]) ? null : strtoupper(test_input($_POST["apellidos"]));
                $cp = empty($_POST["cp"]) ? null : intval(test_input($_POST["cp"]));
                $direccion = empty($_POST["direccion"]) ? null : intval(test_input($_POST["direccion"]));
                $ciudad = empty($_POST["ciudad"]) ? null : intval(test_input($_POST["ciudad"]));
                
                $conn = realizarConexion("comprasweb","localhost","root","rootroot");
                insertarCliente($conn, $nif, $nombre, $apellidos, $cp, $direccion, $ciudad);
                cerrarConexion($conn);
            }
        }
    ?>
</html>