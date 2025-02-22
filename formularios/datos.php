<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>datos.php</title>
        <style>
            table, th, td {
                border:1px solid black;
            }
        </style>
    </head>
    <body>
        <h1>Datos Alumnos</h1>
        <?php
            $nombre = $apellido1 = $apellido2 = $email = $sexo = "";

            $nombre = test_input($_REQUEST["nombre"]);
            $apellido1 = test_input($_REQUEST["apellido1"]);
            $apellido2 = test_input($_REQUEST["apellido2"]);
            $email = test_input($_REQUEST["email"]);
            $sexo = test_input($_REQUEST["sexo"]);

            imprimir($nombre, $apellido1, $apellido2, $email, $sexo);
            guardarArchivo($nombre, $apellido1, $apellido2, $email, $sexo);

            function imprimir($nombre, $apellido1, $apellido2, $email, $sexo) {
                echo "<table>";
                echo "<tr><th>Nombre</th><th>Apellidos</th><th>Email</th><th>Sexo</th></tr>";
                echo "<tr>";
                echo "<td>$nombre</td>";
                echo "<td>$apellido1 $apellido2</td>";
                echo "<td>$email</td>";
                echo "<td>$sexo</td>";
                echo "</tr>";
                echo "</table>";
            }

            function guardarArchivo($nombre, $apellido1, $apellido2, $email, $sexo) {
                $file = fopen("datos.txt", "a");
                fwrite($file, "$nombre, $apellido1, $apellido2, $email, $sexo" . PHP_EOL);
                fclose($file);
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