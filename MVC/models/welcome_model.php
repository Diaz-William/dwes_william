<?php
    function crearSesionCookie($nombre) {
        setcookie("usuario", $nombre, time() + 86400, "/");
    }
?>