<?php
    require_once("../helpers/error_helper.php");
    set_error_handler("error_function");
    require_once("../db/db.php");
    require_once("../helpers/cookie_helper.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["add"])) {
            if (!empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["birthdate"]) && !empty($_POST["gender"]) && !empty($_POST["deptno"]) && !empty($_POST["salary"]) && !empty($_POST["title"])) {
                require_once("../helpers/data_helper.php");
                $firstname = test_input($_POST["firstname"]);
                $lastname = test_input($_POST["lastname"]);
                $birthdate = date("Y-m-d", strtotime(test_input($_POST["birthdate"])));
                $gender = test_input($_POST["gender"]);
                $deptno = test_input($_POST["deptno"]);
                $salary = test_input($_POST["salary"]);
                $title = test_input($_POST["title"]);
                basketEmp($birthdate, $firstname, $lastname, $gender, $deptno, $salary, $title);
            }
        } else if (isset($_POST["hire"]) && isset($_COOKIE["basketEmp"])) {
            require_once("../models/altaEmple_model.php");
            $basketEmp = unserialize($_COOKIE["basketEmp"]);
            $errorEmp = array();
            $indexError = 0;
            foreach ($basketEmp as $index => $dataEmp) {
                list($birthdate, $firstname, $lastname, $gender, $deptno, $salary, $title) = explode("#", $dataEmp);
                $alta = altaEmple($birthdate, $firstname, $lastname, $gender, $deptno, $salary, $title);
                if ($alta === null) {
                    $errorEmp[$indexError] = $dataEmp;
                    $indexError += 1;
                    echo "El nuevo empleado con la posición " . $index + 1 . " en la cesta no se ha contratado";
                }
            }
            vaciarbasketEmp();
            if (count($errorEmp) !== 0) {
                foreach ($errorEmp as $index => $dataEmp) {
                    list($birthdate, $firstname, $lastname, $gender, $deptno, $salary, $title) = explode("#", $dataEmp);
                    basketEmp($birthdate, $firstname, $lastname, $gender, $deptno, $salary, $title);
                }
            }
        } else {
            echo "Tiene que añadir empleados nuevos a la cesta";
        }
    }

    require_once("../models/obtenerDept_model.php");
    $depts = obtenerDept();
    require_once("../views/altaMasiva_view.php");
?>