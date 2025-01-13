<?php
    require_once("views/movlogin.php");
    require_once("models/login_model.php");
    require_once("data_controller.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = test_input("email");
        $password = test_input("password");
        $correcto = comprobar($email, $password);
        echo $correcto;
        if ($correcto === true) {
            //header("Location: ./views/movwelcome.php");
            echo "Dentro";
        } else if ($correcto === false){
            echo "Email o clave incorrectos";
        } else if ($correcto === null) {
            echo "VALOR NULO";
        }
    }
?>