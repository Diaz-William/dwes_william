<?php
    function getDeptEmp($empno) {
        try {
            $conn = conectar();
            $stmt = $conn->prepare("SELECT CONCAT(D.DEPT_NAME, ', desde ', DE.FROM_DATE, ', hasta ', COALESCE(TO_DATE,'la actualidad')) AS INFO FROM DEPT_EMP DE, DEPARTMENTS D WHERE DE.DEPT_NO = D.DEPT_NO AND EMP_NO = :EMP_NO");
            $stmt->bindParam(":EMP_NO", $empno);
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