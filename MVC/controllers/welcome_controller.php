<?php
    require_once("views/welcome_view.php");
    require_once("helpers/cookie_helper.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["cerrar"])) {
            cerrarSesionCookie();
            header("Location: controllers/index.php");
        }
    }
?>