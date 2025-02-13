<?php
    function crearSesionCookie($userdata) {
        list($fullname, $id) = explode("#", $userdata);
        setcookie("usuario", "$fullname#$id", time() + 86400, "/");
    }

    function cerrarSesionCookie() {
        setcookie("usuario", "", time() - 86400, "/");
        setcookie("basketTracks", "", time() - 86400, "/");
        header("Location: ../index.php");
        exit;
    }

    function basketTracks($trackinfo) {
        try {
            $basketTracks = isset($_COOKIE["basketTracks"]) ? unserialize($_COOKIE["basketTracks"]) : array();
            list($trackid, $name, $composer, $unitprice) = explode("#", $trackinfo);
            $basketTracks[$trackid] = "$name#$composer#$unitprice";
            setcookie("basketTracks", serialize($basketTracks), time() + 86400, "/");
            $_COOKIE["basketTracks"] = serialize($basketTracks);
            return true;
        } catch (Exception $e) {
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return false;
        }
    }
    
    function vaciarbasketTracks() {
        setcookie("basketTracks", "", time() - 86400, "/");
        $_COOKIE["basketTracks"] = "";
    }
?>