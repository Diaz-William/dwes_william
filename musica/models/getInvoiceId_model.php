<?php
    function getInvoiceId() {
        try {
            $conn = conectar();
            $stmt = $conn->prepare("SELECT (MAX(InvoiceId) + 1) AS InvoiceId FROM Invoice");
            $stmt->execute();
            $result = $stmt->fetchColumn();
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