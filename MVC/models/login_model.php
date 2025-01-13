<?php
    function comprobar() {
        try {
            $conexion = conectar();
            $stmt = $conexion->prepare("SELECT 1 FROM RCLIENTES WHERE EMAIL = :EMAIL AND IDCLIENTE = :IDCLIENTE");
            $stmt->bindParam(":EMAIL", $email);
            $stmt->bindParam(":IDCLIENTE", $password);
            $stmt->execute();
            $conexion = null;
            $devolver = $stmt === false ? false : true;
            return $devolver;
        } catch (PDOException $ex) {
            echo "Error: ". $ex->getMessage();
            return null;
        }
    }
?>