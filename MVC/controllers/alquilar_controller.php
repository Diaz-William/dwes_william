<?php
    require_once("../db/db.php");
    require_once("../helpers/error_helper.php");
    set_error_handler("error_function");
    require_once("../models/alquilar_model.php");
    require_once("../helpers/cookie_helper.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["agregar"]) && !empty($_POST["vehiculos"])) {
            $auxAgregar = cesta($_POST["vehiculos"]);
        } else if (isset($_POST["alquilar"]) && isset($_COOKIE["cesta"])) {
            $alquilados = comprobarAlquilados();
            $cesta = unserialize($_COOKIE["cesta"]);
            if ((count($cesta) + $alquilados) >= 3) {
                $auxAlquilar = false;
            } else {
                $auxAlquilar = realizarAlquiler($cesta);
            }
        } else if (isset($_POST["vaciar"])) {
            vaciarCesta();
        }
    }

    $vehiculos = obtenerVehiculosDisponibles();

    require_once("../views/cesta_view.php");
    require_once("../views/alquilar_view.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["agregar"]) && empty($_POST["vehiculos"])) {
            echo "Debe seleccionar un vehículo";
        } else if (isset($auxAgregar) && !$auxAgregar) {
            echo "No puede seleccionar más de 3 vehículos";
        } else if (isset($_POST["alquilar"]) && !isset($_COOKIE["cesta"])) {
            echo "Debe añadir vehículos a la cesta";
        } else if (isset($auxAlquilar) && $auxAlquilar) {
            echo "El alquiler se ha realizado correctamente";
        } else if (isset($auxAlquilar) && !$auxAlquilar && ($alquilados - count($cesta)) == 0) {
            echo "Ya tiene 3 vehículos alquilados";
        } else if (isset($auxAlquilar) && !$auxAlquilar) {
            echo "Tiene $alquilados vehículos alquilados, solo puede alquilar ($alquilados - count($cesta)) vehículos";
        }
    }
?>