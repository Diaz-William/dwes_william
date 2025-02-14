<?php
    function getInvoiceDate($fechadesde, $fechahasta) {
        try {
            require_once("../models/getCustomerId_model.php");
            $customerid = getCustomerId();
            $conn = conectar();
            $stmt = $conn->prepare("SELECT InvoiceId, CustomerId, InvoiceDate, BillingAddress, BillingCity, BillingState, BillingCountry, BillingPostalCode, Total FROM Invoice WHERE CustomerId = :CustomerId AND InvoiceDate BETWEEN :FechaDesde AND :FechaHasta");
            $stmt->bindParam(":CustomerId", $customerid);
            $stmt->bindParam(":FechaDesde", $fechadesde);
            $stmt->bindParam(":FechaHasta", $fechahasta);
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