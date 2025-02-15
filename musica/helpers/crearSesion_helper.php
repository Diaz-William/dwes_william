<?php
    function crearSesionCookie($userdata) {
        list($fullname, $id) = explode("#", $userdata);
        setcookie("usuario", "$fullname#$id", time() + 86400, "/");
    }
?>