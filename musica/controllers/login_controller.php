<?php
    require_once("helpers/error_helper.php");
    set_error_handler("error_function");
    require_once("helpers/data_helper.php");
    require_once("views/login_view.php");
    require_once("models/login_model.php");
    require_once("helpers/cookie_helper.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = test_input($_POST["email"]);
        $password = test_input($_POST["password"]);
        $correcto = comprobar($email, $password);
        
        if ($correcto === false) {
            echo "El email o la contraseña son incorrectos";
        } else if ($correcto === true) {
            $userdata = getUserData($email);
            crearSesionCookie($userdata);
            header("Location: controllers/welcome_controller.php");
        } else {
            echo "Ha ocurrido un error. Inténtelo más tarde.";
        }
    }
?>