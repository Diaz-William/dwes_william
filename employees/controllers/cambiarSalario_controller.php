<?php
    require_once("../db/db.php");
    require_once("../helpers/error_helper.php");
    set_error_handler("error_function");
    require_once("../helpers/data_helper.php");
    require_once("../models/obtenerEmp_model.php");
    require_once("../models/cambiarSalario_model.php");

    $empleados = obtenerEmpleados();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["change"]) && !empty($_POST["empno"]) && !empty($_POST["percentage"]) && !empty($_POST["action"])) {
            $empno = test_input($_POST["empno"]);
            $percentage = intval(test_input($_POST["percentage"])) / 100;
            $action = test_input($_POST["action"]);
            $currentsalary = obtenerSalario($empno);
            if ($action === "-") {
                $percentage *= -1;
            }
            $cambio = cambiarSalario($empno, $percentage, $currentsalary);
        }
    }

    require_once("../views/cambiarSalario_view.php");
?>