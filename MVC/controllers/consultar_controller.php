<?php
    require_once("../db/db.php");
    require_once("../helpers/error_helper.php");
    set_error_handler("error_function");
    require_once("../helpers/data_helper.php");
    require_once("../helpers/cookie_helper.php");
    require_once("../models/consultar_model.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["fechadesde"]) || empty($_POST["fechahasta"])) {
            echo "Tiene que introducir las dos fechas";
        } else {
            $fechadesde = date("Y-m-d H:i:s", strtotime(test_input($_POST["fechadesde"]) . "00:00:00"));
            $fechahasta = date("Y-m-d H:i:s", strtotime(test_input($_POST["fechahasta"]) . "23:59:59"));
            $alquilados = consultarAlquileres($fechadesde, $fechahasta);
        }
    }

    require_once("../views/consultar_view.php");
?>