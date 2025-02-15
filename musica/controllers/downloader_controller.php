<?php
    require_once("../helpers/error_helper.php");
    set_error_handler("error_function");

    require_once("../db/db.php");
    require_once("../models/getTracks_model.php");
    $tracks = getTracks();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["add"]) && !empty($_POST["trackinfo"])) {
            require_once("../helpers/addBasket_helper.php");
            $added = basketTracks($_POST["trackinfo"]);
        } else if (isset($_POST["download"]) && isset($_COOKIE["basketTracks"])) {
            header("Location: ./purchases_controller.php");
            exit;
        }
    }

    require_once("../views/downloader_view.php");
?>