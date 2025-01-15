<?php
    require_once("../helpers/error_helper.php");
    set_error_handler("error_function");
    require_once("../views/consultar_view.php");
    require_once("../helpers/cookie_helper.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["fechadesde"]) || empty($_POST["fechahasta"])) {
            echo "Tiene que introducir las dos fechas";
        } else {
            $fechadesde = date("Y-m-d", strtotime(test_input($_POST["fechadesde"])));
            $fechahasta = date("Y-m-d", strtotime(test_input($_POST["fechahasta"])));
            var_dump($fechadesde);
            var_dump($fechahasta);
        }
    }
?>