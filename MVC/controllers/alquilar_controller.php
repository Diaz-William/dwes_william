<?php
    /*header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");*/
    
    require_once("../db/db.php");
    require_once("../helpers/error_helper.php");
    set_error_handler("error_function");
    require_once("../models/alquilar_model.php");
    require_once("../helpers/cookie_helper.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["agregar"]) && !empty($_POST["vehiculos"])) {
            cesta($_POST["vehiculos"]);
        } else {
            echo "Debe seleccionar un vehículo";
        }
    }

    $vehiculos = obtenerVehiculosDisponibles();

    require_once("../views/cesta_view.php");
    require_once("../views/alquilar_view.php");
?>