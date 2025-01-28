<?php
    require_once("../db/db.php");
    require_once("../helpers/error_helper.php");
    set_error_handler("error_function");
    require_once("../helpers/data_helper.php");
    require_once("../models/obtenerEmp_model.php");

    $empleados = obtenerEmpleados();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["consult"]) && !empty($_POST["emp"]) && !empty($_POST["info"])) {
            $dataEmp = test_input($_POST["emp"]);
            $info = test_input($_POST["info"]);
            list($empno, $fullname) = explode("#", $dataEmp);

            switch ($info) {
                case "dataEmp":
                    require_once("../models/datosEmp_model.php");
                    $info = getDataEmp($empno);
                    break;
                case "depts":
                    require_once("../models/deptEmp_model.php");
                    $info = getDeptEmp($empno);
                    break;
                case "salaries":
                    require_once("../models/salaryEmp_model.php");
                    $info = getSalEmp($empno);
                    break;
                case "titles":
                    require_once("../models/titlesEmp_model.php");
                    $info = getTitEmp($empno);
                    break;
            }
        }
    }

    require_once("../views/vidaLaboral_view.php");
?>