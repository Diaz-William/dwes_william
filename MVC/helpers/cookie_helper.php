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
        // Divide los datos del vehículo en sus componentes.
        list($matricula, $marca, $modelo) = explode("#", $vehiculo);
    
        // Si la cookie "cesta" ya existe, deserialízala; de lo contrario, crea un array vacío.
        $cesta = isset($_COOKIE["cesta"]) ? unserialize($_COOKIE["cesta"]) : array();
    
        // Agrega o actualiza el vehículo en la cesta.
        $cesta[$matricula] = $marca . "#" . $modelo;
    
        // Serializa y guarda la cookie "cesta".
        setcookie("cesta", serialize($cesta), time() + 86400, "/");
    
        // Actualiza el superglobal para uso inmediato en el script.
        $_COOKIE["cesta"] = serialize($cesta);
    }
    
?>