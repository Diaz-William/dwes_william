<?php
    function getCustomerId() {
        try {
            if (isset($_COOKIE["usuario"])) {
                list(, $customerid) = explode("#", $_COOKIE["usuario"]);
                return $customerid;
            }
            return false;
        } catch (Exception $e) {
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return null;
        }
    }
?>