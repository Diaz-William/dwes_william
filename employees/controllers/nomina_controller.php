<?php
    require_once("../db/db.php");
    require_once("../helpers/error_helper.php");
    set_error_handler("error_function");
    require_once("../helpers/data_helper.php");
    require_once("../models/getEmpData_model.php");

    list(, $empno) = explode("#", $_COOKIE["usuario"]);
    $empdata = getEmpData($empno);

    require_once("../views/nomina_view.php");
?>