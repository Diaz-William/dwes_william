<?php
    require_once("views/movlogin.php");
    require_once("models/login_model.php");
    require_once("data_controller.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = test_input("email");
        $password = test_input("password");
        $correcto = comprobar();
        if ($correcto) {
            header("Location: ./movwelcome.php");
        } else {
            echo "Email o clave incorrectos";
        }
    }
?>