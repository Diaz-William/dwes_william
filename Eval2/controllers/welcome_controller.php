<?php
    require_once("../helpers/error_helper.php");
    set_error_handler("error_function");

    // Verificar si la solicitud es de tipo POST.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Si se presiona el botón "reservar".
        if (isset($_POST["reservar"])) {
            header("Location: ./reservas_controller.php"); // Redirigir a la página de reservas.
            exit;
        } 
        // Si se presiona el botón "download".
        else if (isset($_POST["consultar"])) {
            header("Location: ./consultas_controller.php"); // Redirigir a la página de consultas.
            exit;
        } 
        // Si se presiona el botón "empty".
        else if (isset($_POST["salir"])) {
            header("Location: ./loguot_controller.php"); // Redirigir a la página de inicio.
            exit;
        }
    }

    // Incluir la vista para mostrar la interfaz de bienvenida.
    require_once("../views/welcome_view.php");
?>