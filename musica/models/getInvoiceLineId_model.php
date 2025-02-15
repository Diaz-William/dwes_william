<?php
    function getInvoiceLineId() {
        try {
            $conn = conectar();
            $stmt = $conn->prepare("SELECT (MAX(InvoiceLineId) + 1) AS InvoiceLineId FROM InvoiceLine");
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