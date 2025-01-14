<?php
    require_once("views/login_view.php");
    require_once("models/login_model.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = test_input($_POST["email"]);
        $password = test_input($_POST["password"]);
        $nombre = comprobar($email, $password);
        
        if (gettype($nombre) === 'string') {
            header("Location: ./views/welcome_view.php");
        } else if ($nombre === false){
            echo "Email o clave innombres";
        }
    }
?>