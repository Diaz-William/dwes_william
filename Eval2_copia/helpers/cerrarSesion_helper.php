<?php
    function cerrarSesionCookie() {
        setcookie("usuario", "", time() - 86400, "/");
        setcookie("cesta", "", time() - 86400, "/");
        header("Location: ../index.php");
        exit;
    }
?>