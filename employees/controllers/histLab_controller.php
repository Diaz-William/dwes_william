<?php
    require_once("../db/db.php");
    require_once("../helpers/error_helper.php");
    set_error_handler("error_function");
    require_once("../helpers/data_helper.php");
    require_once("../models/histLab_model.php");

    list(, $empno) = explode("#", $_COOKIE["usuario"]);
    require_once("../models/deptEmp_model.php");
    $deptEmp = getDeptEmp($empno);
    require_once("../models/salaryEmp_model.php");
    $salEmp = getSalEmp($empno);

    require_once("../views/histLab_view.php");
?>