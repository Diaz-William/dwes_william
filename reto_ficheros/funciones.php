<?php
    function obtenerXML($nombre) {
        $nombre .= ".xml";
        var_dump($nombre);
        $xml = simplexml_load_file($nombre) or die("Error: No se puede crear el objeto");
        return $xml;
    }

    function imprimirTabla($nombre) {
        echo "<table>";
        echo "<tr>";
        echo "<td>$nombre</td>";
        echo "<td>fecha</td>";
        echo "<td>fecha</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Periodo</td>";
        echo "<td>06-12h</td>";
        echo "<td>06-12h</td>";
        echo "<td>06-12h</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Precipitacion</td>";
        echo "<td>100%</td>";
        echo "<td>100%</td>";
        echo "<td>100%</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Viento</td>";
        echo "<td>SO 20</td>";
        echo "<td>SO 20</td>";
        echo "<td>SO 20</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Sensacion</td>";
        echo "<td>20</td>";
        echo "<td>20</td>";
        echo "<td>20</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Temp</td>";
        echo "<td>13/22</td>";
        echo "<td>13/22</td>";
        echo "</tr>";
        echo "</table>";
    }