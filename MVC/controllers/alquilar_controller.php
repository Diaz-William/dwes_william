<?php
    require_once("../db/db.php");
    require_once("../helpers/error_helper.php");
    set_error_handler("error_function");
    require_once("../models/alquilar_model.php");
    require_once("../helpers/cookie_helper.php");
    require_once("../views/cesta_view.php");

    $vehiculos = obtenerVehiculosDisponibles();

    require_once("../views/alquilar_view.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["agregar"])) {
            cesta($_POST["vehiculos"]);
        }
    }
?>