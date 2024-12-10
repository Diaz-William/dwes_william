<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="William Diaz">
        <title>Registro</title>
    </head>
    <body>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required>
            <br><br>
            <label for="apellido">1º Apellido:</label>
            <input type="text" name="apellido" id="apellido" required>
            <br><br>
            <label for="direccion">Dirección:</label>
            <input type="text" name="direccion" id="direccion" required>
            <br><br>
            <label for="ciudad">Ciudad:</label>
            <input type="text" name="ciudad" id="ciudad" required>
            <br><br>
            <label for="pais">País:</label>
            <input type="text" name="pais" id="pais" required>
            <br><br>
            <label for="clave">Clave:</label>
            <input type="password" name="clave" id="clave" required>
            <br><br>
            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" id="telefono" required>
            <br><br>
            <input type="submit" name="registrarse" id="registrarse" value="Registrarse">
        </form>
        <?php
            // Incluir el archivo de funciones.
            include "funciones_pe_sigin.php";
            // Incluir el archivo de manejo de errores.
            include "errores.php";
            // Establecer la función "error_function" para el manejo de errores.
            set_error_handler("error_function");

            // Comprobar si se han enviado los datos del formulario por el método POST.
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $contactFirstName = test_input($_POST["nombre"]);
                $contactLastName = test_input($_POST["apellido"]);
                $addressLine1 = test_input($_POST["direccion"]);
                $city = test_input($_POST["ciudad"]);
                $country = test_input($_POST["pais"]);
                $hashPassword = password_hash(test_input($_POST["clave"]), PASSWORD_DEFAULT);
                $phone = test_input($_POST["telefono"]);
                insertarCliente($contactFirstName, $contactLastName, $addressLine1, $city, $country, $hashPassword, $phone);
            }
        ?>
    </body>
</html>