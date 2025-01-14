<?php
    function comprobar($email, $password) {
        try {
            $conexion = conectar();
            $stmt = $conexion->prepare("SELECT NOMBRE FROM RCLIENTES WHERE EMAIL = :EMAIL AND IDCLIENTE = :IDCLIENTE");
            $stmt->bindParam(':EMAIL', $email);
            $stmt->bindParam(':IDCLIENTE', $password);
            $stmt->execute();
            $result = $stmt->fetchColumn();
            
            if (comprobarPendientePago($email, $password, $conexion)) {
                $result = "Pendiente de pago";
            } else if (comprobarBaja($email, $password, $conexion)) {
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