<?php
    function crearSesionCookie($nombre, $id) {
        setcookie("datos", $nombre."#".$id, time() + 86400, "/");
    }

    function cerrarSesionCookie() {
        setcookie("datos", "", time() - 86400, "/");
        setcookie("cesta", "", time() - 86400, "/");
        setcookie("datosPago", "", time() - 86400, "/");
        header("Location: ../index.php");
    }

    function cesta($vehiculo) {
        list($matricula, $marca, $modelo) = explode("#", $vehiculo);
        $cesta = isset($_COOKIE["cesta"]) ? unserialize($_COOKIE["cesta"]) : array();

        if (count($cesta) >= 3) {
            return false;
        } else {
            $cesta[$matricula] = $marca . "#" . $modelo;
            setcookie("cesta", serialize($cesta), time() + 86400, "/");
            $_COOKIE["cesta"] = serialize($cesta);
            return true;
        }
    }
    
    function vaciarCesta() {
        setcookie("cesta", "", time() - 86400, "/");
        $_COOKIE["cesta"] = "";
    }
?>