<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>fichero4.php</title>
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
            $fichero = fopen("alumnos2.txt", "r") or die("No se ha podido abrir el archivo");
            $datos = file("alumnos2.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            fclose($fichero);
            $lineas = count($datos);
            $datosLinea = array();

            echo "<table>";
            echo "<tr>";
            echo "<th>Nombre</th>";
            echo "<th>Apellido 1</th>";
            echo "<th>Apellido 2</th>";
            echo "<th>Nacimiento</th>";
            echo "<th>Localidad</th>";
            echo "</tr>";

            foreach ($datos as $x) {
                echo "<tr>";
                $datosLinea = explode("##", $x);
                foreach ($datosLinea as $y) {
                    echo "<td>$y</td>";
                }
                echo "</tr>";
            }

            echo "</table>";

            echo "<p>Se han leído $lineas lineas</p>";
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