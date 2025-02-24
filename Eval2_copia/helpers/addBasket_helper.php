<?php
    function cesta($infovuelo, $numasientos) {
        try {
            // Obtener el carrito desde la cookie (si existe).
            $cesta = isset($_COOKIE["cesta"]) ? unserialize($_COOKIE["cesta"]) : array();

            // Extraer los valores del vuelo recibido como parámetro.
            list($id_vuelo, $datos) = explode("#", $infovuelo);

            // Verificar si la pista ya está en el carrito.
            if (isset($cesta[$id_vuelo])) {
                list($origen, $salida, $destino, $llegada, $precio, $asientos) = explode(";", $cesta[$id_vuelo]);
                $asientos += $numasientos; // Incrementar cantidad de asientos.
                // Guardar en el array.
                $cesta[$id_vuelo] = "$origen;$salida;$destino;$llegada;$precio;$asientos";
            } else {
                list($origen, $salida, $destino, $llegada, $precio) = explode(";", $datos);
                // Guardar en el array.
                $cesta[$id_vuelo] = "$origen;$salida;$destino;$llegada;$precio;$numasientos";
            }

            // Serializar y actualizar la cookie.
            setcookie("cesta", serialize($cesta), time() + 86400, "/");
            // Actualizar la variable global de la cookie.
            $_COOKIE["cesta"] = serialize($cesta);
            return true;
        } catch (Exception $e) {
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return false;
        }
    }
?>