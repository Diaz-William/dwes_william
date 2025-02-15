<?php
    function vaciarbasketTracks() {
        setcookie("basketTracks", "", time() - 86400, "/");
        $_COOKIE["basketTracks"] = "";
    }
?>