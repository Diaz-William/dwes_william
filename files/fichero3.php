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
            
            /*$nombre = trim(file_get_contents("alumnos1.txt", FALSE, NULL, 1, 40));
            $apellido1 = trim(file_get_contents("alumnos1.txt", FALSE, NULL, 41, 81));
            $apellido2 = trim(file_get_contents("alumnos1.txt", FALSE, NULL, 82, 123));
            $nacimiento = trim(file_get_contents("alumnos1.txt", FALSE, NULL, 124, 133));
            $localidad = trim(file_get_contents("alumnos1.txt", FALSE, NULL, 134, 160));*/
            
            fclose($fichero);

            echo "<pre>";
            echo print_r($datos);
            echo "</pre>";

            /*echo "$nombre <br>";
            echo "$apellido1 <br>";
            echo "$apellido2 <br>";
            echo "$nacimiento <br>";
            echo "$localidad <br>";*/
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