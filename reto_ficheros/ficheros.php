<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php
            $xml = simplexml_load_file('pronosticotiempoLasRozas.xml') or die("Error: No se puede crear el objeto");

            echo $xml -> provincia;
            echo $xml -> prediccion;
        ?>
    </body>
</html>