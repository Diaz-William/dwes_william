<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="William Diaz">
        <title>Inicio de Sesión</title>
    </head>
    <body>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="customerNumber">customerNumber:</label>
            <input type="text" name="customerNumber" id="customerNumber">
            <br><br>
            <label for="contactLastName">contactLastName:</label>
            <input type="password" name="contactLastName" id="contactLastName">
            <br><br>
            <input type="submit" name="iniciar" id="iniciar" value="Iniciar Sesión">
        </form>

        <?php
            // Incluir el archivo de funciones.
            include "funciones_pe_login.php";
            // Incluir el archivo de manejo de errores.
            include "errores.php";
            // Establecer la función "error_function" para el manejo de errores.
            set_error_handler("error_function");

            // Comprobar si se han enviado los datos del formulario por el método POST.
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $customerNumber = test_input($_POST["customerNumber"]);
                $contactLastName = password_hash(test_input($_POST["contactLastName"]), PASSWORD_DEFAULT);
                var_dump($contactLastName);
                if (empty($customerNumber) || empty($contactLastName)) {
                    trigger_error("Tiene que introducir el customerNumber y el contactLastName");
                }else {
                    if (comprobarUsuario($customerNumber)) {
                        if (!comprobarUsusarioBloqueado($customerNumber)) {
                            if (comprobarClave($customerNumber, $contactLastName)) {
                                reiniciarErroresSesion($customerNumber);
                                crearSesionCookies($customerNumber);
                            }else {
                                aumentarErroresSesión($customerNumber);
                                //☻
                                if (!comprobarUsusarioBloqueado($customerNumber)) {
                                    trigger_error("El usuario con el número $customerNumber está bloqueado");
                                }
                            }
                        }else {
                            trigger_error("El usuario con el número $customerNumber está bloqueado");
                        }
                    }else {
                        trigger_error("El customerNumber $customerNumber no existe");
                    }
                }
            }
        ?>
    </body>
</html>