<?php
    function pay($invoiceid, $invoicedate, $amount, $cardnumber, $paid) {
        try {
            $conn = conectar();
            require_once("../models/getCustomerId_model.php");
            $customerid = getCustomerId();
            $conn->beginTransaction();
            $stmt = $conn->prepare("INSERT INTO Invoice (InvoiceId, CustomerId, InvoiceDate, BillingAddress, BillingCity, BillingState, BillingCountry, BillingPostalCode, Total, Paid, CardNumber) VALUES (:InvoiceId, :CustomerId, :InvoiceDate, NULL, NULL, NULL, NULL, NULL, :Total, :Paid, :CardNumber)");
            $stmt->bindParam(":InvoiceId", $invoiceid);
            $stmt->bindParam(":CustomerId", $customerid);
            $stmt->bindParam(":InvoiceDate", $invoicedate);
            $amount *= 100;
            $stmt->bindParam(":Total", $amount);
            $stmt->bindParam(":Paid", $paid);
            $stmt->bindParam(":CardNumber", $cardnumber);
            $stmt->execute();
            $basketTracks = unserialize($_COOKIE["basketTracks"]);
            require_once("../models/getInvoiceLineId_model.php");
            foreach ($basketTracks as $trackid => $trackinfo) {
                list(, , $unitprice, $quantity) = explode("#", $trackinfo);
                $stmt = $conn->prepare("INSERT INTO InvoiceLine (InvoiceLineId, InvoiceId, TrackId, UnitPrice, Quantity) VALUES InvoiceLine (:InvoiceLineId, :InvoiceId, :TrackId, :UnitPrice, :Quantity)");
                $invoicelineid = getInvoiceLineId();
                $stmt->bindParam(":InvoiceLineId", $invoicelineid);
                $stmt->bindParam(":InvoiceId", $invoiceid);
                $stmt->bindParam(":TrackId", $trackid);
                $stmt->bindParam(":UnitPrice", $unitprice);
                $stmt->bindParam(":Quantity", $quantity);
                $stmt->execute();
            }
            $conn->commit();
        } catch (PDOException $e) {
            if ($conn) {
                $conn->rollBack();
                $conn = null;
            }
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return null;
        }
    }
?>