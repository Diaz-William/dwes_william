<?php
    function comprobarAsientos() {
        try {
            $cesta = unserialize($_COOKIE["cesta"]);
            $comprar = true;
            $conn = conectar();

            foreach ($cesta as $id_vuelo => $datos) {
                list(, , , , $asientos) = explode(";", $datos);
                $stmt = $conn->prepare("SELECT asientos_disponibles FROM vuelos WHERE id_vuelo = :id_vuelo");
                $stmt->bindParam(":id_vuelo", $id_vuelo);
                $stmt->execute();
                $result = $stmt->fetchColumn();

                $comprar = ($result - $asientos) > 0 ? true : false;
            }

            $conn = null;
            return $comprar;
        } catch (PDOException $e) {
            if ($conn) {
                $conn = null;
            }
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return null;
        }
    }
?>