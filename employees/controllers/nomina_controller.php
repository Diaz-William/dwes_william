<?php
    require_once("../db/db.php");
    require_once("../helpers/error_helper.php");
    set_error_handler("error_function");
    require_once("../helpers/data_helper.php");
    require_once("../models/getEmpData_model.php");
    require_once("../models/getEmpSal_model.php");

    list(, $empno) = explode("#", $_COOKIE["usuario"]);
    $empdata = getEmpData($empno);
    $salary = getEmpSal($empno);
    $x = comprobarEngineer($empno);
    var_dump($x);

    require_once("../views/nomina_view.php");
?>