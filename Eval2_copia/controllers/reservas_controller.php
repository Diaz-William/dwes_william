<?php
    // Incluir el archivo de manejo de errores y establecer la función personalizada para manejar errores.
    require_once("../helpers/error_helper.php");
    set_error_handler("error_function");

    // Incluir el archivo de conexión a la base de datos y el modelo para obtener los vuelos con asientos disponibles.
    require_once("../db/db.php");
    require_once("../models/obtenerVuelos_model.php");

    // Obtener los vuelos con asientos disponibles.
    $vuelos = obtenerVuelos();

    // Verificar si la solicitud es de tipo POST.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Si se presiona el botón "agregar" y se envía información del vuelo.
        if (isset($_POST["agregar"]) && !empty($_POST["vuelos"]) && !empty($_POST["asientos"])) {
            if (intval($_POST["asientos"]) > 0) {
                require_once("../helpers/addBasket_helper.php"); // Incluir el helper para agregar a la cesta.
                $added = cesta($_POST["vuelos"], $_POST["asientos"]); // Agregar el vuelo a la cesta.
            }
        } 
        // Si se presiona el botón "comprar" y hay vuelos en la cesta (cookie).
        else if (isset($_POST["comprar"]) && isset($_COOKIE["cesta"])) {
            require_once("../models/comprobarAsientos_model.php");
            $comprar = comprobarAsientos();
            if ($comprar) {
                require_once("../models/comprar_model.php");
                $comprado = comprar();
                if ($comprado) {
                    require_once("../helpers/emptyBasket_helper.php"); // Incluir el helper para vaciar la cesta.
                    vaciarCesta(); // Vaciar la cesta.
                }
            }
        }
        // Si se presiona el botón "empty", vaciar la cesta.
        else if (isset($_POST["vaciar"])) {
            require_once("../helpers/emptyBasket_helper.php"); // Incluir el helper para vaciar la cesta.
            vaciarCesta(); // Vaciar la cesta.
        }
        // Si se presiona el botón "volver", vaciar la cesta.
        else if (isset($_POST["volver"])) {
            header("Location: ./welcome_controller.php"); // Redirigir a la página de bienvenida.
            exit;
        }
    }

    // Incluir la vista para mostrar la interfaz de reservas.
    require_once("../views/reservas_view.php");
?>