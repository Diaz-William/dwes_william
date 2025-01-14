<?php
    require_once("views/login_view.php");
    require_once("models/login_model.php");
    require_once("helpers/cookie_helper.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = test_input($_POST["email"]);
        $password = test_input($_POST["password"]);
        $nombre = comprobar($email, $password);
        
        if ($nombre === false) {
            echo "Email o clave incorrectos";
        } elseif ($nombre === "Pendiente de pago" || $nombre === "La cuenta ha sido dada de baja") {
            echo $nombre;
        } elseif (is_string($nombre)) {
            crearSesionCookie($nombre, $password);
            header("Location: controllers/welcome_controller.php");
        } else {
            echo "Ha ocurrido un error. Inténtelo más tarde.";
        }
    }
?>