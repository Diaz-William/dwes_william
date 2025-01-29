<?php
    function getDeptData($deptno) {
        try {
            $conn = conectar();
            $stmt = $conn->prepare("SELECT CONCAT('Departamento: ', D.DEPT_NAME, ' (', D.DEPT_NO, '), ', 'Manager: ', COALESCE(DM.EMP_NO, 'Sin manager'), ', ', 'Empleado: ', DE.EMP_NO) AS INFO FROM DEPARTMENTS D, DEPT_MANAGER DM, DEPT_EMP DE WHERE D.DEPT_NO = DM.DEPT_NO AND D.DEPT_NO = DE.DEPT_NO AND D.DEPT_NO = :DEPT_NO OR DM.DEPT_NO IS NULL OR DE.DEPT_NO IS NULL ORDER BY D.DEPT_NO, DM.EMP_NO, DE.EMP_NO");
            $stmt->bindParam("DEPT_NO", $deptno);
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