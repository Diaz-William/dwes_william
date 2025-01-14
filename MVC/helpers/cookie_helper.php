<?php
    function crearSesionCookie($nombre, $id) {
        setcookie("datos", $nombre."#".$id, time() + 86400, "/");
    }
?>