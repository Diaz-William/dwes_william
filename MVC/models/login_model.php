<?php
    function comprobar($email, $password) {
        try {
            $conexion = conectar();
            $stmt = $conexion->prepare("SELECT NOMBRE, APELLIDO FROM RCLIENTES WHERE EMAIL = :EMAIL AND IDCLIENTE = :IDCLIENTE");
            $stmt->bindParam(':EMAIL', $email);
            $stmt->bindParam(':IDCLIENTE', $password);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            var_dump($result);
            $result = !empty($result) ? $result["NOMBRE"] . " " . $result["APELLIDO"] : false;
            
            if (comprobarPendientePago($email, $password, $conexion) && $result !== false) {
                $result = "Pendiente de pago";
            } else if (comprobarBaja($email, $password, $conexion) && $result !== false) {
                $result = "La cuenta ha sido dada de baja";
            }

            $conexion = null;

            return $result;
        } catch (PDOException $e) {
            $conexion = null;
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return null;
        }
    }

    function comprobarPendientePago($email, $password, $conexion) {
        try {
            $stmt = $conexion->prepare("SELECT 1 FROM RCLIENTES WHERE EMAIL = :EMAIL AND IDCLIENTE = :IDCLIENTE AND PENDIENTE_PAGO = 0");
            $stmt->bindParam(':EMAIL', $email);
            $stmt->bindParam(':IDCLIENTE', $password);
            $stmt->execute();
            return $stmt->fetchColumn() === false;
        } catch (PDOException $e) {
            $conexion = null;
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return null;
        }
    }

    function comprobarBaja($email, $password, $conexion) {
        try {
            $stmt = $conexion->prepare("SELECT 1 FROM RCLIENTES WHERE EMAIL = :EMAIL AND IDCLIENTE = :IDCLIENTE AND FECHA_BAJA IS NULL");
            $stmt->bindParam(':EMAIL', $email);
            $stmt->bindParam(':IDCLIENTE', $password);
            $stmt->execute();
            return $stmt->fetchColumn() === false;
        } catch (PDOException $e) {
            $conexion = null;
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return null;
        }
    }
?>