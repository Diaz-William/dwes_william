<?php
    require_once("helpers/error_helper.php");
    set_error_handler("error_function");
    require_once("helpers/data_helper.php");
    require_once("views/login_view.php");
    require_once("models/login_model.php");
    require_once("helpers/cookie_helper.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $empno = test_input($_POST["empno"]);
        $password = test_input($_POST["password"]);
        $correcto = comprobar($empno, $password);
        
        if ($correcto === false) {
            echo "El número del empleado, la contraseña son incorrectos o el usuario ha sido bloqueado";
        } else if ($correcto === true) {
            $fullname = getUserData($empno);
            crearSesionCookie($fullname, $empno);
            if (comprobarRRHH($empno)) {
                header("Location: controllers/welcomeRRHH_controller.php");
            } else {
                header("Location: controllers/welcomeEmployees_controller.php");
            }
        } else {
            echo "Ha ocurrido un error. Inténtelo más tarde.";
        }
    }
?>