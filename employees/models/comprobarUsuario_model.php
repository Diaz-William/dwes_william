<?php
    function comprobar($empno, $lastname) {
        try {
            $conn = conectar();
            $stmt = $conn->prepare("SELECT EMP_NO, LAST_NAME FROM EMPLOYEES WHERE EMP_NO = :EMP_NO AND LAST_NAME = :LAST_NAME");
            $stmt->bindParam(':EMP_NO', $empno);
            $stmt->bindParam(':LAST_NAME', $lastname);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $conn = null;
            return $result !== false;
        } catch (PDOException $e) {
            if ($conn) {
                $conn = null;
            }
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return null;
        }
    }
?>