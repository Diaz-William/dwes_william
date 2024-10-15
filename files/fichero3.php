<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>fichero3.php</title>
        <style>
            table, th, td {
                border:1px solid black;
            }
        </style>
    </head>
    <body>
    <h1>Datos Alumnos</h1>
    <?php
        imprimir();

        function imprimir() {
            $fichero = fopen("alumnos1.txt", "r") or die("No se ha podido abrir el archivo");
            $datos = file("alumnos1.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            fclose($fichero);

            echo "<table>";
            echo "<tr>";
            echo "<th>Nombre</th>";
            echo "<th>Apellido 1</th>";
            echo "<th>Apellido 2</th>";
            echo "<th>Nacimiento</th>";
            echo "<th>Localidad</th>";
            echo "</tr>";
            
            foreach ($datos as $x) {
                $nombre = trim(substr($x, 0, (40 - 0)));
                $apellido1 = trim(substr($x, 40, (81 - 40)));
                $apellido2 = trim(substr($x, 81, (123 - 81)));
                $nacimiento = trim(substr($x, 123, (133 - 123)));
                $localidad = trim(substr($x, 133, (160 - 133)));
                echo "<tr>";
                echo "<td>$nombre</td>";
                echo "<td>$apellido1</td>";
                echo "<td>$apellido2</td>";
                echo "<td>$nacimiento</td>";
                echo "<td>$localidad</td>";
                echo "</tr>";
            }
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