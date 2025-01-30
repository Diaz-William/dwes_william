<?php
    function bajaEmp($empno) {
        try {
            $conn = conectar();
            $stmt = $conn->prepare("SELECT 1 FROM EMPLOYEES WHERE EMP_NO = :EMP_NO AND BLOCKED = 0");
            $stmt->bindParam(":EMP_NO", $empno);
            $stmt->execute();
            $result = $stmt->fetchColumn();
            if ($result !== false) {
                $conn->beginTransaction();
                $stmt = $conn->prepare("UPDATE EMPLOYEES SET BLOCKED = TRUE WHERE EMP_NO = :EMP_NO");
                $stmt->bindParam(":EMP_NO", $empno);
                $stmt->execute();
                $conn->commit();
                $result = true;
            }
            $conn = null;
            return $result !== false;
        } catch (PDOException $e) {
            if ($conn) {
                $conn->rollBack();
                $conn = null;
            }
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return null;
        }
    }
?>