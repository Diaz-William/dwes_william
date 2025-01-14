<?php
    function crearSesionCookie($nombre, $id) {
        setcookie("datos", $nombre."#".$id, time() + 86400, "/");
    }

    function cerrarSesionCookie() {
        setcookie("datos", "", time() - 86400, "/");
        header("Location: ../index.php");
    }
?>