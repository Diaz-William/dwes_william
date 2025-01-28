<?php
    function getTitEmp($empno) {
        try {
            $conn = conectar();
            $stmt = $conn->prepare("SELECT CONCAT('Cargo de ', TITLE, ' desde ', FROM_DATE, ' hasta ', COALESCE(TO_DATE,'la actualidad'))) AS INFO FROM TITLES");
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