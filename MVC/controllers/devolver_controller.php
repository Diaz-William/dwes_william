<?php
    require_once("../db/db.php");
    require_once("../helpers/error_helper.php");
    set_error_handler("error_function");
    require_once("../models/devolver_model.php");

    date_default_timezone_set('Europe/Madrid');
    $alquilados = obtenerVehiculosAlquilados();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fecha_devolver = date("Y-m-d H:i:s");
        var_dump($fecha_devolver);
    }

    require_once("../views/devolver_view.php");
?>