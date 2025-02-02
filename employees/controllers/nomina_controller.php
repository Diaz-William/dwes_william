<?php
    require_once("../db/db.php");
    require_once("../helpers/error_helper.php");
    set_error_handler("error_function");
    require_once("../helpers/data_helper.php");
    require_once("../models/getEmpData_model.php");
    require_once("../models/getEmpSal_model.php");
    require_once("../models/comprobarEngineer_model.php");

    list(, $empno) = explode("#", $_COOKIE["usuario"]);

    $empdata = getEmpData($empno);
    $salary = getEmpSal($empno);
    $engineer = comprobarEngineer($empno);

    if ($engineer) {
        $salary += 10000;
    }

    $seguridad_social = $salary * 0.075;
    if ($salary < 40000) {
        $irpf = $salary * 0.10;
    } elseif ($salary >= 40000 && $salary < 70000) {
        $irpf = $salary * 0.20;
    } else {
        $irpf = $salary * 0.30;
    }

    $net_salary = $salary - $seguridad_social - $irpf;

    require_once("../models/comprobarRRHH_model.php");
    require_once("../views/nomina_view.php");
?>
