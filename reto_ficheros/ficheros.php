<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php
            include 'errores_sistema.php';
            set_error_handler("error_function");

            $xml = simplexml_load_file('pronosticotiempoLasRozas.xml') or die("Error: No se puede crear el objeto");

            $nombre = $xml -> nombre;
            $prediccion = $xml -> prediccion;

            foreach ($prediccion -> dia['fecha'] as $f) {
                echo $f;
            }


            var_dump($prediccion);
        ?>
    </body>
</html>