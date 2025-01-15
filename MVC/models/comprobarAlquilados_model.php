<?php
    function comprobarAlquilados() {
        try {
            $conn = conectar();
            $stmt = $conn->prepare("SELECT IDCLIENTE FROM RALQUILERES WHERE IDCLIENTE = :IDCLIENTE");
            $id = explode("#", $_COOKIE["datos"]);
            $id = $id[1];
            $stmt->bindParam("IDCLIENTE", $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            $conn = null;
            return count($result);
        } catch (PDOException $e) {
            $conn = null;
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return null;
        }
    }
?>