<?php
    function getDeptData($deptno) {
        try {
            $conn = conectar();
            $result = array();
            $stmt = $conn->prepare("SELECT E.EMP_NO AS MANAGER, E.FIRST_NAME, E.LAST_NAME FROM EMPLOYEES E, DEPT_MANAGER DM WHERE E.EMP_NO = DM.EMP_NO AND DM.DEPT_NO = :DEPT_NO");
            $stmt->bindParam(":DEPT_NO", $deptno);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            $stmt = $conn->prepare("SELECT E.EMP_NO, E.FIRST_NAME, E.LAST_NAME FROM EMPLOYEES E, DEPT_EMP DE WHERE E.EMP_NO = DE.EMP_NO AND DE.DEPT_NO = :DEPT_NO");
            $stmt->bindParam(":DEPT_NO", $deptno);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            //$result += $stmt->fetchAll();
            $result = array_merge($result, $stmt->fetchAll());
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