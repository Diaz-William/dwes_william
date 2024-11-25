<?php
//--------------------------------------------------------------------------
    // Función para crear la sesión con cookies.
    function crearCookies($usuario, $contrasena) {
        setcookie("usuario", $usuario, time() + 86400, "/");
        setcookie("contrasena", $contrasena, time() + 86400, "/");
        header("Location: ./web1_cookies.php");
    }
//--------------------------------------------------------------------------
    // Función para cerrar sesión eliminando cookies.
    function eliminarCookies() {
        setcookie("usuario", "", time() - 3600, "/");
        setcookie("contrasena", "", time() - 3600, "/");
        header("Location: ./inicio_cookie.php");
    }
//--------------------------------------------------------------------------