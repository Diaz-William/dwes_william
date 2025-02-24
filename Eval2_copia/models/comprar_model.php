<?php
    function comprar() {
        try {
            // 
            require_once("../models/obtenerPkReservas_model.php");
            $id_reserva = obtenerPkReservas();

            //
            require_once("../models/obtenerDNI_model.php");
            $dni = obtenerDNI();

            //
            date_default_timezone_set('Europe/Madrid');
            $date = date("Y-m-d");

            // Establece la conexión con la base de datos
            $conn = conectar();

            $conn->beginTransaction();

            $cesta = unserialize($_COOKIE["cesta"]);
            if ($cesta !== false) {
                foreach ($cesta as $id_vuelo => $datos) {
                    list(, , , , $precio, $asientos) = explode(";", $datos);
                    $total = $precio * $asientos;
                    // Prepara la consulta SQL para obtener la lista de pistas descargadas por el cliente en el rango de fechas
                    $stmt = $conn->prepare("INSERT INTO reservas (id_reserva, id_vuelo, dni_cliente, fecha_reserva, num_asientos, preciototal) VALUES (:id_reserva, :id_vuelo, :dni_cliente, :fecha_reserva, :num_asientos, :preciototal)");

                    // Asigna los valores a los parámetros de la consulta
                    $stmt->bindParam(":id_reserva", $id_reserva);
                    $stmt->bindParam(":id_vuelo", $id_vuelo);
                    $stmt->bindParam(":dni_cliente", $dni);
                    $stmt->bindParam(":fecha_reserva", $date);
                    $stmt->bindParam(":num_asientos", $asientos);
                    $stmt->bindParam(":preciototal", $total);

                    // Ejecuta la consulta
                    $stmt->execute();

                    $stmt = $conn->prepare("UPDATE vuelos SET asientos_disponibles = asientos_disponibles - :asientos WHERE id_vuelo = :id_vuelo");
                    $stmt->bindParam(":id_vuelo", $id_vuelo);
                    $stmt->bindParam(":asientos", $asientos);

                    $stmt->execute();
                }
            }


            //
            $conn->commit();

            // Cierra la conexión con la base de datos
            $conn = null;

            // Retorna el resultado obtenido
            return true;
        } catch (PDOException $e) {
            // En caso de error, cierra la conexión si está abierta
            if ($conn) {
                $conn->rollBack();
                $conn = null;
            }

            // Llama a una función personalizada para manejar el error
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());

            // Retorna null en caso de error
            return null;
        }
    }
?>