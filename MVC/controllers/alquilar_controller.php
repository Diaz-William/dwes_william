<?php
    require_once("../db/db.php");
    require_once("../helpers/error_helper.php");
    set_error_handler("error_function");
    require_once("../models/alquilar_model.php");
    require_once("../helpers/cookie_helper.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["agregar"]) && !empty($_POST["vehiculos"])) {
            $auxAgregar = cesta($_POST["vehiculos"]);
        } else if (isset($_POST["alquilar"])) {
            if (isset($_COOKIE["cesta"]) && !empty($_COOKIE["cesta"])) {
                $cesta = unserialize($_COOKIE["cesta"]);
                $alquilados = comprobarAlquilados();
                if ((count($cesta) + $alquilados) > 3) {
                    $auxAlquilar = false;
                } else {
                    $auxAlquilar = realizarAlquiler($cesta);
                    if ($auxAlquilar) {
                        vaciarCesta();
                    }
                }
            }
        } else if (isset($_POST["vaciar"])) {
            vaciarCesta();
        }
    }

    $vehiculos = obtenerVehiculosDisponibles();
    require_once("../views/cesta_view.php");
    require_once("../views/alquilar_view.php");

    
?>