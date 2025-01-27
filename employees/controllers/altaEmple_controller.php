<?php
    require_once("../helpers/error_helper.php");
    set_error_handler("error_function");
    require_once("../db/db.php");
    require_once("../helpers/data_helper.php");
    require_once("../models/altaEmple_model.php");
    require_once("../helpers/cookie_helper.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $firstname = test_input($_POST["firstname"]);
        $lastname = test_input($_POST["lastname"]);
        $birthdate = date("Y-m-d", strtotime(test_input($_POST["birthdate"])));
        $gender = test_input($_POST["gender"]);
        $deptno = test_input($_POST["deptno"]);
        $salary = test_input($_POST["salary"]);
        $title = test_input($_POST["title"]);

        $c = altaEmple($birthdate, $firstname, $lastname, $gender, $deptno, $salary, $title);
        var_dump($c);
        var_dump($firstname);
        var_dump($lastname);
        var_dump($birthdate);
        var_dump($gender);
        var_dump($deptno);
        var_dump($salary);
        var_dump($title);
    }

    require_once("../models/obtenerDept_model.php");
    $depts = obtenerDept();
    require_once("../views/altaEmple_view.php");
?>