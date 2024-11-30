<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="William Diaz">
        <title>Inicio de Sesión</title>
    </head>
    <body>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" id="usuario">
            <br><br>
            <label for="clave">Clave:</label>
            <input type="password" name="clave" id="clave">
            <br><br>
            <input type="submit" name="iniciar" id="iniciar" value="Iniciar Sesión">
        </form>

        <?php
            // Incluir el archivo "funciones_dados_compras.php".
            include "funciones_bbdd_compras.php";
            // Incluir el archivo "errores_sistema_compras.php".
            include "errores_sistema_compras.php";
            // Establecer la función "error_function" para el manejo de errores.
            set_error_handler("error_function");

            // Comprobar si se han enviado los datos del formulario por el método POST.
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $usuario = strtoupper(test_input($_POST["usuario"]));
                $clave = strtoupper(test_input($_POST["clave"]));
                if (empty($usuario) || empty($clave)) {
                    trigger_error("Tiene que introducir el usuario y la clave");
                }else {
                    if (comprobarUsuario($usuario)) {
                        if (comprobarClave($usuario, $clave)) {
                            crearSesionCookies($usuario, $clave);
                        }else {
                            trigger_error("La clave es incorrecta");
                        }
                    }else {
                        trigger_error("El usuario $usuario no existe");
                    }
                }
            }
        ?>
    </body>
</html>