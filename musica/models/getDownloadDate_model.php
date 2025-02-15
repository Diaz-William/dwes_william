<?php
    function getDownloadDate($fechadesde, $fechahasta) {
        try {
            require_once("../models/getCustomerId_model.php");
            $customerid = getCustomerId();
            $conn = conectar();
            $stmt = $conn->prepare("SELECT t.Name, IFNULL(t.Composer, 'N/A') AS Composer, i.InvoiceDate, il.Quantity FROM Track t, InvoiceLine il, Invoice i WHERE i.CustomerId = :CustomerId AND il.InvoiceId = i.InvoiceId AND t.TrackId = il.TrackId AND i.InvoiceDate BETWEEN :FechaDesde AND :FechaHasta ORDER BY il.Quantity DESC");
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