<?php
    function cambiarDeptMan($empno, $deptno) {
        try {
            date_default_timezone_set('Europe/Madrid');
            $conn = conectar();
            $stmt = $conn->prepare("SELECT 1 FROM DEPT_MANAGER WHERE EMP_NO = :EMP_NO AND DEPT_NO = :DEPT_NO AND TO_DATE IS NULL");
            $stmt->bindParam(":EMP_NO", $empno);
            $stmt->bindParam(":DEPT_NO", $deptno);
            $stmt->execute();
            $result = $stmt->fetchColumn();
            if ($result === false) {
                $conn->beginTransaction();
                $stmt = $conn->prepare("UPDATE DEPT_MANAGER SET TO_DATE = :DATE WHERE EMP_NO = :EMP_NO AND TO_DATE IS NULL");
                $stmt->bindParam(":EMP_NO", $empno);
                $date = date("Y-m-d");
                $stmt->bindParam(":DATE", $date);
                $stmt->execute();
                $stmt = $conn->prepare("INSERT INTO DEPT_MANAGER (EMP_NO, DEPT_NO, FROM_DATE, TO_DATE) VALUES (:EMP_NO, :DEPT_NO, :DATE, NULL)");
                $stmt->bindParam(":EMP_NO", $empno);
                $stmt->bindParam(":DEPT_NO", $deptno);
                $stmt->bindParam(":DATE", $date);
                $stmt->execute();
                $conn->commit();
            }
            $conn = null;
            return $result === false;
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