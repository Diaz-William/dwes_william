<?php
    function comprobar($email, $password) {
        try {
            $conexion = conectar();
            $stmt = $conexion->prepare("SELECT NOMBRE FROM RCLIENTES WHERE EMAIL = :EMAIL AND IDCLIENTE = :IDCLIENTE");
            $stmt->bindParam(':EMAIL', $email);
            $stmt->bindParam(':IDCLIENTE', $password);
            $stmt->execute();
            $result = $stmt->fetchColumn();
            $conexion = null;
            return $result;
        } catch (PDOException $e) {
            $conexion = null;
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return null;
        }
    }

    function crearSesionCookie($nombre) {
        setcookie("usuario", $nombre, time() + 86400, "/");
    }
?>