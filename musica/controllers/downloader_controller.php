<?php
    require_once("../helpers/error_helper.php");
    set_error_handler("error_function");

    require_once("../db/db.php");
    require_once("../models/getTracks_model.php");
    $tracks = getTracks();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["add"]) && !empty($_POST["trackinfo"])) {
            require_once("../helpers/addBasket_helper.php");
            $added = basketTracks($_POST["trackinfo"]);
        } else if (isset($_POST["download"]) && isset($_COOKIE["basketTracks"])) {
            header("Location: ./purchase_controller.php");
            exit;
        } else if (isset($_POST["empty"])) {
            require_once("../helpers/emptyBasket_helper.php");
            vaciarbasketTracks();
        }
    }

    require_once("../views/downloader_view.php");
?>

<?php
    // Incluir el archivo de manejo de errores y establecer la función personalizada para manejar errores.
    /*require_once("../helpers/error_helper.php");
    set_error_handler("error_function");

    // Incluir el archivo de conexión a la base de datos y el modelo para obtener pistas de audio.
    require_once("../db/db.php");
    require_once("../models/getTracks_model.php");

    // Obtener la lista de pistas de la base de datos.
    $tracks = getTracks();

    // Verificar si la solicitud es de tipo POST.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Si se presiona el botón "add" y se envía información de la pista.
        if (isset($_POST["add"]) && !empty($_POST["trackinfo"])) {
            require_once("../helpers/addBasket_helper.php"); // Incluir el helper para agregar al carrito.
            $added = basketTracks($_POST["trackinfo"]); // Agregar la pista al carrito.
        } 
        // Si se presiona el botón "download" y hay pistas en el carrito (cookie).
        else if (isset($_POST["download"]) && isset($_COOKIE["basketTracks"])) {
            header("Location: ./purchase_controller.php"); // Redirigir a la página de compra.
            exit;
        } 
        // Si se presiona el botón "empty", vaciar el carrito.
        else if (isset($_POST["empty"])) {
            require_once("../helpers/emptyBasket_helper.php"); // Incluir el helper para vaciar el carrito.
            vaciarbasketTracks(); // Vaciar el carrito.
        }
    }

    // Incluir la vista para mostrar la interfaz del downloader.
    require_once("../views/downloader_view.php");
?>