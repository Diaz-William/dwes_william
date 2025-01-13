<?php
    require_once("views/login_view.php");
    require_once("models/login_model.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = test_input($_POST["email"]);
        $password = test_input($_POST["password"]);
        $correcto = comprobar($email, $password);
        
        if ($correcto === true) {
            header("Location: ./views/welcome_view.php");
        } else if ($correcto === false){
            echo "Email o clave incorrectos";
        } else if ($correcto === null) {
            echo $correcto;
        }
    }
?>