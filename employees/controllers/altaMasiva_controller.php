<?php
    require_once("../helpers/error_helper.php");
    set_error_handler("error_function");
    require_once("../db/db.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["add"])) {
            require_once("../helpers/data_helper.php");
            $firstname = test_input($_POST["firstname"]);
            $lastname = test_input($_POST["lastname"]);
            $birthdate = date("Y-m-d", strtotime(test_input($_POST["birthdate"])));
            $gender = test_input($_POST["gender"]);
            $deptno = test_input($_POST["deptno"]);
            $salary = test_input($_POST["salary"]);
            $title = test_input($_POST["title"]);
            require_once("../helpers/cookie_helper.php");
            basketEmp($birthdate, $firstname, $lastname, $gender, $deptno, $salary, $title);
        } else if (isset($_POST["hire"]) && isset($_COOKIE["basketEmp"])) {
            require_once("../models/altaEmple_model.php");
            $basketEmp = unserialize($_COOKIE["basketEmp"]);
            foreach ($basketEmp as $index => $dataEmp) {
                var_dump($index);
                var_dump($dataEmp);
                // altaEmple($birthdate, $firstname, $lastname, $gender, $deptno, $salary, $title);
            }
        } else {
            echo "Tiene que añadir empleados nuevos a la cesta";
        }
    }

    require_once("../models/obtenerDept_model.php");
    $depts = obtenerDept();
    require_once("../views/altaMasiva_view.php");
?>