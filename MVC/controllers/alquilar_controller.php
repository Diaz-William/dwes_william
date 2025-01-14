<?php
    require_once("../helpers/error_helper.php");
    set_error_handler("error_function");
    require_once("../models/alquilar_model.php");

    $vehiculos = obtenerVehiculosDisponibles();

    require_once("../views/alquilar_view.php");
?>