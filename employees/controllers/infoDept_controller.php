<?php
    require_once("../db/db.php");
    require_once("../helpers/error_helper.php");
    set_error_handler("error_function");
    require_once("../helpers/data_helper.php");
    require_once("../models/obtenerDept_model.php");
    require_once("../models/getDeptData_model.php");

    $depts = obtenerDept();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["consult"]) && !empty($_POST["deptdata"])) {
            list($deptno, $deptname) = explode("#", test_input($_POST["deptdata"]));
            $info = getDeptData($deptno);
        }
    }

    require_once("../views/infoDept_view.php");
?>