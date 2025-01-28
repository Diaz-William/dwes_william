<?php
    require_once("../db/db.php");
    require_once("../helpers/error_helper.php");
    set_error_handler("error_function");
    require_once("../helpers/data_helper.php");
    require_once("../models/obtenerEmp_model.php");

    $empleados = obtenerEmpleados();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["consult"]) && !empty($_POST["empno"]) && !empty($_POST["info"])) {
            $empno = test_input($_POST["empno"]);
            $info = test_input($_POST["info"]);

            switch ($info) {
                case "dataEmp":
                    require_once("../models/datosEmp_model.php");
                    $info = getDataEmp($empno);
                    break;
                case "depts":
                    require_once("../models/datosEmp_model.php");
                    // funcion();
                    break;
                case "salaries":
                    require_once("../models/datosEmp_model.php");
                    // funcion();
                    break;
                case "titles":
                    require_once("../models/datosEmp_model.php");
                    // funcion();
                    break;
            }
        }
    }

    require_once("../views/vidaLaboral_view.php");
?>