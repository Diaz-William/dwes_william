<?php
    require_once("../helpers/error_helper.php");
    set_error_handler("error_function");
    require_once("../helpers/data_helper.php");
    //require_once("../models/purchases_model.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //code...
    }

    require_once("../views/purchases_view.php");
?>