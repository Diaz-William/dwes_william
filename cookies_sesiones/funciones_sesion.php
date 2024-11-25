<?php
//--------------------------------------------------------------------------
    // Función para crear la sesión.
    function crearSesion($usuario, $contrasena) {
        session_start();
        $_SESSION["usuario"] = $usuario;
        $_SESSION["contrsena"] = $contrasena;
        header("Location: ./web1_sesion.php");
    }
//--------------------------------------------------------------------------
    // Función para cerrar sesión.
    function cerrarSesion() {
        session_unset();
        session_destroy();
        setcookie("PHPSESSID", "", time() - 3600, "/");
        header("Location: ./inicio_sesion.php");
    }
//--------------------------------------------------------------------------