<?php
    function cambiarDeptEmp($empno, $deptno) {
        try {
            date_default_timezone_set('Europe/Madrid');
            $conn = conectar();
            $stmt = $conn->prepare("SELECT 1 FROM DEPT_EMP WHERE EMP_NO = :EMP_NO AND DEPT_NO = :DEPT_NO");
            $stmt->bindParam(":EMP_NO", $empno);
            $stmt->bindParam(":DEPT_NO", $deptno);
            $stmt->execute();
            $result = $stmt->fetchColumn();
            var_dump($empno);
            var_dump($deptno);
            var_dump($result);
            if ($result === false) {
                $conn->beginTransaction();
                $stmt = $conn->prepare("UPDATE DEPT_EMP SET DEPT_NO = :DEPT_NO, TO_DATE = :DATE WHERE EMP_NO = :EMP_NO");
                $stmt->bindParam(":DEPT_NO", $deptno);
                $stmt->bindParam(":EMP_NO", $empno);
                $date = date("Y-m-d");
                $stmt->bindParam(":DATE", $date);
                $stmt->execute();
                $stmt = $conn->prepare("INSERT INTO DEPT_EMP (EMP_NO, DEPT_NO, FROM_DATE, TO_DATE) VALUES (:EMP_NO, :DEPT_NO, :DATE, NULL)");
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