<?php
    require_once("helpers/error_helper.php");
    set_error_handler("error_function");
    require_once("helpers/data_helper.php");
    require_once("models/getTracks_model.php");
    require_once("helpers/cookie_helper.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["add"]) && !empty($_POST["trackinfo"])) {
            $added = basketTracks($trackinfo);
        } else if (isset($_POST["download"]) && isset($_COOKIE["basketTracks"])) {
            header("Location: ../purchases_controller.php");
            exit;
        }
    }

    require_once("views/downloader_view.php");
?>