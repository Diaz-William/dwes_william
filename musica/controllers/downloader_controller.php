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
            header("Location: ./purchase_controller.php");
            exit;
        } else if (isset($_POST["empty"])) {
            require_once("../helpers/emptyBasket_helper.php");
            vaciarbasketTracks();
        }
    }

    require_once("../views/downloader_view.php");
?>