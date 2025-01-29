<?php
    function getDeptData($deptno) {
        try {
            $conn = conectar();
            $result = array();
            $stmt = $conn->prepare("SELECT E.EMP_NO AS MANAGER, CONCAT(E.FIRST_NAME, ' ', E.LAST_NAME) AS FULLNAMEMANAGER FROM EMPLOYEES E, DEPT_MANAGER DM WHERE E.EMP_NO = DM.EMP_NO AND DM.DEPT_NO = :DEPT_NO");
            $stmt->bindParam(":DEPT_NO", $deptno);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            $stmt = $conn->prepare("SELECT E.EMP_NO, CONCAT(E.FIRST_NAME, ' ', E.LAST_NAME) AS FULLNAME FROM EMPLOYEES E, DEPT_EMP DE WHERE E.EMP_NO = DE.EMP_NO AND DE.DEPT_NO = :DEPT_NO AND E.EMP_NO != :MANAGER_EMP_NO");
            $stmt->bindParam(":DEPT_NO", $deptno);
            $stmt->bindParam(":MANAGER_EMP_NO", $result[0]['MANAGER']);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
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