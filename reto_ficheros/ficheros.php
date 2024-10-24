<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
            table, th, td {
                border:1px solid black;
            }
        </style>
    </head>
    <body>
        <?php
            include 'funciones.php';
            include 'errores_sistema.php';
            set_error_handler("error_function");

            $xml1 = obtenerXML("pronosticotiempoLasRozas.xml");
            $xml2 = obtenerXML("pronosticotiempoMadrid.xml");

            imprimirTablaXml($xml1);
            imprimirTablaXml($xml2);

            $censo = obtenerDatos("CensoProvinciaHombresMujeres.csv");
            imprimirTablaCsv($censo);
        ?>
    </body>
</html>