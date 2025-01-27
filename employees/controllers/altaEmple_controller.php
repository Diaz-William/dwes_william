<?php
    require_once("../helpers/error_helper.php");
    set_error_handler("error_function");
    require_once("../db/db.php");
    require_once("../helpers/data_helper.php");
    require_once("../views/altaEmple_view.php");
    require_once("../models/altaEmple.php");
    require_once("../helpers/cookie_helper.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = test_input($_POST["name"]);
        $lastname = test_input($_POST["lastname"]);
        $birthdate = test_input($_POST["birthdate"]);
        $gender = test_input($_POST["gender"]);
    }
?>