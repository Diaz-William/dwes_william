<?php
    function obtenerXML($nombre) {
        $nombre .= ".xml";
        var_dump($nombre);
        $xml = simplexml_load_file($nombre) or die("Error: No se puede crear el objeto");
        return $xml;
    }

    function imprimirTabla($nombre, $fechas) {
        echo "<table>";
        echo "<tr>";
        echo "<td>$nombre</td>";
        foreach ($fechas as $fecha) {
            echo "<td colspan='3'>$fecha</td>";
        }
        echo "</tr>";
        echo "</table>";
    }