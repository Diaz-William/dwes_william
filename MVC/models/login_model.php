<?php
    function comprobar() {
        try {
            $conexion = conectar();
            $stmt = $conexion->prepare("SELECT 1 FROM RCLIENTES WHERE EMAIL = :EMAIL AND IDCLIENTE = :IDCLIENTE");
            $stmt->bindParam(":EMAIL", $email);
            $stmt->bindParam(":IDCLIENTE", $password);
            $stmt->execute();
            $conexion = null;
            return $stmt->fetchColumn() === false ? false : true;
        } catch (PDOException $ex) {
            echo "Error: ". $ex->getMessage();
            return null;
        }
    }
?>