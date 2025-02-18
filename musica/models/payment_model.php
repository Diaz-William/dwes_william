<?php
    function pay($invoiceid, $invoicedate, $amount, $cardcountry, $paid) {
        try {
            $conn = conectar();
            require_once("../models/getCustomerId_model.php");
            $customerid = getCustomerId();
            $conn->beginTransaction();
            //$stmt = $conn->prepare("INSERT INTO Invoice (InvoiceId, CustomerId, InvoiceDate, BillingAddress, BillingCity, BillingState, BillingCountry, BillingPostalCode, Total, Paid, CardCountry) VALUES (:InvoiceId, :CustomerId, :InvoiceDate, NULL, NULL, NULL, NULL, NULL, :Total, :Paid, :CardCountry)");

            $stmt = $conn->prepare("INSERT INTO Invoice (InvoiceId, CustomerId, InvoiceDate, BillingAddress, BillingCity, BillingState, BillingCountry, BillingPostalCode, CardCountry, Total, Paid) SELECT :InvoiceId, CustomerId, :InvoiceDate, Address, City, COALESCE(State, NULL), Country, COALESCE(PostalCode, NULL), :CardCountry, :Total, :Paid FROM Customer WHERE CustomerId = :CustomerId");

            $stmt->bindParam(":InvoiceId", $invoiceid);
            $stmt->bindParam(":InvoiceDate", $invoicedate);
            $stmt->bindParam(":CardCountry", $cardcountry);
            $amount /= 100;
            $stmt->bindParam(":Total", $amount);
            $stmt->bindParam(":Paid", $paid);
            $stmt->bindParam(":CustomerId", $customerid);
            $stmt->execute();

            $basketTracks = unserialize($_COOKIE["basketTracks"]);
            require_once("../models/getInvoiceLineId_model.php");

            foreach ($basketTracks as $trackid => $trackinfo) {
                list(, , $unitprice, $quantity) = explode("#", $trackinfo);

                $stmt = $conn->prepare("INSERT INTO InvoiceLine (InvoiceLineId, InvoiceId, TrackId, UnitPrice, Quantity) VALUES (:InvoiceLineId, :InvoiceId, :TrackId, :UnitPrice, :Quantity)");

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