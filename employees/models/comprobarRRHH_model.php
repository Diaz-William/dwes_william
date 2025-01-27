<?php
    function comprobarRRHH($empno) {
        try {
            $conn = conectar();
            $stmt = $conn->prepare("SELECT 1 FROM DEPT_EMP WHERE EMP_NO = :EMP_NO AND DEPT_NO = 'd003'");
            $stmt->bindParam(':EMP_NO', $empno);
            $stmt->execute();
            $result = $stmt->fetchColumn() !== false;
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