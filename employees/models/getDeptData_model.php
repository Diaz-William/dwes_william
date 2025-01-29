<?php
    function getDeptData($deptno) {
        try {
            $conn = conectar();
            $stmt = $conn->prepare("SELECT D.DEPT_NO AS 'Número de Departamento', D.DEPT_NAME AS 'Nombre del Departamento', DM.EMP_NO AS 'Número de Manager', DE.EMP_NO AS 'Número de Empleado' FROM DEPARTMENTS D, DEPT_MANAGER DM, DEPT_EMP DE WHERE D.DEPT_NO = DM.DEPT_NO AND D.DEPT_NO = DE.DEPT_NO AND D.DEPT_NO = :DEPT_NO ORDER BY D.DEPT_NO, DM.EMP_NO, DE.EMP_NO;");
            $stmt->execute();
            $stmt->bindParam("DEPT_NO", $deptno);
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