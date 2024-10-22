<?php
    include 'errores_sistema.php';
    set_error_handler("error_function");
    function obtenerXML($nombre) {
        $nombre += ".xml";
        $xml = simplexml_load_file($nombre) or die("Error: No se puede crear el objeto");
        return $xml;
    }

    function imprimirTabla($nombre) {
        echo "<table>";
        echo "<tr>";
        echo "<td>$nombre</td>";
        echo "</tr>";
        echo "</table>";
    }