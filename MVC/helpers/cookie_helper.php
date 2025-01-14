<?php
    function crearSesionCookie($nombre, $id) {
        setcookie("datos", $nombre."#".$id, time() + 86400, "/");
    }

    function cerrarSesionCookie() {
        setcookie("datos", "", time() - 86400, "/");
        setcookie("cesta", "", time() - 86400, "/");
        header("Location: ../index.php");
    }

    function cesta($vehiculo) {
        list($matricula, $marca, $modelo) = explode("#", $vehiculo);

        if (!isset($_COOKIE["cesta"])) {
            setcookie("datos", $matricula, time() + 86400, "/");
        }

        $cesta = isset($_COOKIE["cesta"]) ? unserialize($_COOKIE["cesta"]) : array();
        $cesta[$matricula] = $marca."#".$modelo;
        setcookie("cesta", serialize($cesta), time() + 86400, "/");
    }
?>