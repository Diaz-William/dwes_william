<?php
    require_once("../helpers/error_helper.php");
    set_error_handler("error_function");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST["fechadesde"]) && !empty($_POST["fechahasta"])) {
            require_once("../helpers/data_helper.php");
            $fechadesde = date("Y-m-d H:i:s", strtotime(test_input($_POST["fechadesde"]) . "00:00:00"));
            $fechahasta = date("Y-m-d H:i:s", strtotime(test_input($_POST["fechahasta"]) . "23:59:59"));
            require_once("../db/db.php");
            require_once("../models/getDownloadDate_model.php");
            $downloads = getDownloadDate($fechadesde, $fechahasta);
        }
    }

    require_once("../views/dateHistDownload_view.php");
?>