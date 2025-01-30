<?php
    require_once("../db/db.php");
    require_once("../helpers/error_helper.php");
    set_error_handler("error_function");
    require_once("../helpers/data_helper.php");
    require_once("../models/obtenerEmp_model.php");
    require_once("../models/obtenerDept_model.php");
    require_once("../models/cambiarDeptEmp_model.php");

    $empleados = obtenerEmpleados();
    $depts = obtenerDept();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["change"]) && !empty($_POST["empdata"]) && !empty($_POST["deptdata"])) {
            list($empno, $empname) = explode("#", test_input($_POST["empdata"]));
            list($deptno, $deptname) = explode("#", test_input($_POST["deptdata"]));
            $change = cambiarDeptEmp($empno, $deptno);
        }
    }

    require_once("../views/cambiarDeptEmp_view.php");
?>