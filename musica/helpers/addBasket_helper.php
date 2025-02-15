<?php
    function basketTracks($trackinfo) {
        try {
            // Obtener el carrito desde la cookie (si existe).
            $basketTracks = isset($_COOKIE["basketTracks"]) ? unserialize($_COOKIE["basketTracks"]) : array();

            // Extraer los valores del trackinfo recibido como parámetro.
            list($trackId, $name, $composer, $unitprice) = explode("#", $trackinfo);

            // Verificar si la pista ya está en el carrito.
            if (isset($basketTracks[$trackId])) {
                list($name, $composer, $unitprice, $quantity) = explode("#", $basketTracks[$trackId]);
                $quantity += 1; // Incrementar cantidad
            } else {
                $quantity = 1;
            }

            // Guardar en el array.
            $basketTracks[$trackId] = "$name#$composer#$unitprice#$quantity";
            // Serializar y actualizar la cookie.
            setcookie("basketTracks", serialize($basketTracks), time() + 86400, "/");
            // Actualizar la variable global de la cookie.
            $_COOKIE["basketTracks"] = serialize($basketTracks);
            return true;
        } catch (Exception $e) {
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return false;
        }
    }
?>