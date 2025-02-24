<?php
    function getAmount() {
        try {
            $conn = conectar();
            $basketTracks = isset($_COOKIE["basketTracks"]) ? unserialize($_COOKIE["basketTracks"]) : null;
            if (!is_null($basketTracks)) {
                $amount = 0;
                foreach ($basketTracks as $trackid => $trackinfo) {
                    list(, , $unitprice, $quantity) = explode("#", $trackinfo);
                    $amount += $unitprice * $quantity;
                }
                $amount = round($amount, 2) * 100;
                return $amount;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            if ($conn) {
                $conn = null;
            }
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return null;
        }
    }
?>