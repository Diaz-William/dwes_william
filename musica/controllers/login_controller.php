<?php
    require_once("helpers/error_helper.php");
    set_error_handler("error_function");
    require_once("views/login_view.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once("helpers/data_helper.php");
        $email = test_input($_POST["email"]);
        $password = test_input($_POST["password"]);
        require_once("models/login_model.php");
        $correcto = comprobar($email, $password);
        
        if ($correcto === true) {
            require_once("helpers/cookie_helper.php");
            $userdata = getUserData($email);
            crearSesionCookie($userdata);
            header("Location: controllers/welcome_controller.php");
            exit;
        }
    }
?>