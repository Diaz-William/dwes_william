<?php
    function cerrarSesionCookie() {
        setcookie("usuario", "", time() - 86400, "/");
        setcookie("basketTracks", "", time() - 86400, "/");
        header("Location: ../index.php");
        exit;
    }
?>