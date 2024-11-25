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
            <label for="contrasena">Contraseña:</label>
            <input type="password" name="contrasena" id="contrasena">
            <br><br>
            <input type="submit" name="iniciar" id="iniciar" value="Iniciar Sesión">
        </form>

        <?php
            // Incluir el archivo de funciones.
            include 'funciones.php';
            // Incluir el archivo de manejo de errores.
            include 'errores.php';
            // Establecer la función "error_function" para el manejo de errores.
            set_error_handler("error_function");

            // Comprobar si se han enviado los datos del formulario por el método POST.
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $usuario = strtoupper(test_input($_POST["usuario"]));
                $contrasena = test_input($_POST["contrasena"]);
                if (empty($usuario) || empty($contrasena)) {
                    trigger_error("Tiene que introducir el usuario y la contraseña");
                }else {
                    if (comprobarUsuario( $usuario)) {
                        if (comprobarContrasena( $usuario, $contrasena)) {
							 var_dump($_SESSION);
                            crearSesion($usuario, $contrasena);
							 var_dump($_SESSION);
                        }else {
                            trigger_error("La contraseña es incorrecta");
                        }
                    }else {
                        trigger_error("El usuario $usuario no existe");
                    }
                }
            }
        ?>
    </body>
</html>