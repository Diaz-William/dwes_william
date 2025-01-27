<?php
    function altaEmple($birthdate, $firstname, $lastname, $gender) {
        try {
            date_default_timezone_set('Europe/Madrid');
            $conn = conectar();
            $conn->beginTransaction();
            $stmt = $conn->prepare("INSERT INTO EMPLOYEES (EMP_NO, BIRTH_DATE, FIRST_NAME, LAST_NAME, GENDER, HIRE_DATE) VALUES (:EMP_NO, :BIRTH_DATE, :FIRST_NAME, :LAST_NAME, :GENDER, :HIRE_DATE)");
            $empno = obtenerSigEmpNo($conn);
            $stmt->bindParam(":EMP_NO", $empno);
            $stmt->bindParam(":BIRTH_DATE", $birthdate);
            $stmt->bindParam(":FIRST_NAME", $firstname);
            $stmt->bindParam(":LAST_NAME", $lastname);
            $stmt->bindParam(":GENDER", $gender);
            $hiredate = date("Y-m-d");
            $stmt->bindParam(":HIRE_DATE", $hiredate);
            $stmt->execute();
            $stmt = $conn->prepare("INSERT INTO DEPT_EMP (EMP_NO, DEPT_NO, FROM_DATE, TO_DATE) VALUES (:EMP_NO, :DEPT_NO, :FROM_DATE, NULL)");
            $stmt->bindParam(":EMP_NO", $empno);
            $stmt->bindParam(":DEPT_NO", $empno);
            $stmt->bindParam(":FROM_DATE", $empno);
            $stmt->execute();
            $stmt = $conn->prepare("INSERT INTO SALARIES (EMP_NO, SALARY, FROM_DATE, TO_DATE) VALUES (:EMP_NO, :SALARY, :FROM_DATE, NULL)");
        } catch (PDOException $e) {
            if ($conn) {
                $conn->rollBack();
                $conn = null;
            }
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return null;
        }
    }

    function obtenerSigEmpNo($conn) {
        try {
            $stmt = $conn->prepare("SELECT MAX(EMP_NO) + 1 FROM EMPLOYEES");
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return null;
        }
    }
?>