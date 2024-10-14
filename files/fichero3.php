<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>fichero3.php</title>
    </head>
    <body>
    <h1>Datos Alumnos</h1>
    <?php
        imprimir();

        function imprimir() {
            $fichero = fopen("alumnos1.txt", "r") or die("No se ha podido abrir el archivo");
            $datos = file("alumnos1.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            
            $nombre = substr($datos[0], 0, (40 - 0));
            $apellido1 = substr($datos[0], 40, (81 - 40));
            $apellido2 = substr($datos[0], 81, (123 - 81));
            $nacimiento = substr($datos[0], 123, (133 - 123));
            $localidad = substr($datos[0], 133, (160 - 133));
            
            fclose($fichero);

            echo "<pre>";
            echo print_r($datos);
            echo "</pre>";

            echo "$nombre <br>";
            echo "$apellido1 <br>";
            echo "$apellido2 <br>";
            echo "$nacimiento <br>";
            echo "$localidad <br>";
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>
    </body>
</html>