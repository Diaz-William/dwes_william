<?php
    require_once("views/login_view.php");
    require_once("models/login_model.php");
    require_once("helpers/cookie_helper.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = test_input($_POST["email"]);
        $password = test_input($_POST["password"]);
        $nombre = comprobar($email, $password);
        
        if ($nombre !== "Pendiente pago" || $nombre !== "La cuenta ha sido dada de baja") {
            crearSesionCookie($nombre, $password);
            header("Location: ./views/welcome_view.php");
        } else if ($nombre === false){
            echo "Email o clave innombres";
        } else if (gettype($nombre) =='string') {
            echo $nombre;
        }
    }
?>