<?php
    function basketTracks($trackinfo) {
        try {
            $basketTracks = isset($_COOKIE["basketTracks"]) ? unserialize($_COOKIE["basketTracks"]) : array();
            $index = count($basketTracks) !== 0 ? count($basketTracks) : 0;
            $basketTracks[$index] = $trackinfo;
            setcookie("basketTracks", serialize($basketTracks), time() + 86400, "/");
            $_COOKIE["basketTracks"] = serialize($basketTracks);
            return true;
        } catch (Exception $e) {
            error_function($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return false;
        }
    }
?>