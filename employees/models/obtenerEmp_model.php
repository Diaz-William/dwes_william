<?php
    function obtenerEmpleados() {
        try {
            $conn = conectar();
            $stmt = $conn->prepare("SELECT EMP_NO, FIRST_NAME, LAST_NAME FROM EMPLOYEES");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            $conn = null;
            return $result;
        } catch (PDOException $e) {
            if ($conn) {
                $conn = null;
            }
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return null;
        }
    }
?>