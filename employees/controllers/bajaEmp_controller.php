<?php
    require_once("../db/db.php");
    require_once("../helpers/error_helper.php");
    set_error_handler("error_function");
    require_once("../helpers/data_helper.php");
    require_once("../models/obtenerEmp_model.php");
    require_once("../models/bajaEmp_model.php");

    $empleados = obtenerEmpleados();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["blocked"]) && !empty($_POST["empdata"])) {
            list($empno, $empname) = explode("#", test_input($_POST["empdata"]));
            $blocked = bajaEmp($empno);
        }
    }

    require_once("../views/bajaEmp_view.php");
?>