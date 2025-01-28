<?php
    require_once("../db/db.php");
    require_once("../helpers/error_helper.php");
    set_error_handler("error_function");
    require_once("../models/obtenerEmp_model.php");
    require_once("../models/cambiarSalario_model.php");

    $empleados = obtenerEmpleados();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["change"]) && !empty($_POST["empno"]) && !empty($_POST["percentage"]) && !empty($_POST["action"])) {
            $empno = test_input($_POST["empno"]);
            $percentage = intval(test_input($_POST["percentage"]));
            $action = test_input($_POST["action"]);
            if ($action === "-") {
                $percentage *= -1;
            }
            cambiarSalario($empno, $percentage);
        } else {
            echo "Tiene que seleccionar y rellenar todos los datos";
        }
    }

    require_once("../views/cambiarSalario_view.php");
?>