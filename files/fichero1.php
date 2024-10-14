<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>fichero1.php</title>
    </head>
    <body>
    <h1>Datos Alumnos</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label>Nombre</label>
        <input type="text" name="nombre">
        <br><br>
        <label>Apellido 1</label>
        <input type="text" name="apellido1">
        <br><br>
        <label>Apellido 2</label>
        <input type="text" name="apellido2">
        <br><br>
        <label>Fecha de nacimiento</label>
        <input type="nacimiento" name="nacimiento">
        <br><br>
        <label>Localidad</label>
        <input type="localidad" name="localidad">
        <br><br>
        <input type="submit" value="Enviar">
        <input type="reset" value="Borrar">
    </form>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nombre = test_input($_POST["nombre"]);
                $apellido1 = test_input($_POST["apellido1"]);
                $apellido2 = test_input($_POST["apellido2"]);
                $nacimiento = test_input($_POST["nacimiento"]);
                $localidad = test_input($_POST["localidad"]);

                $nombre = str_pad($nombre, 40, " ", STR_PAD_RIGHT);
                $apellido1 = str_pad($apellido1,40," ", STR_PAD_RIGHT);
                $apellido2 = str_pad($apellido2, 41, " ", STR_PAD_RIGHT);
                $nacimiento = str_pad($nacimiento,9," ", STR_PAD_RIGHT);
                $localidad = str_pad($localidad,24," ", STR_PAD_RIGHT);

                guardarArchivo($nombre, $apellido1, $apellido2, $nacimiento, $localidad);
            }
            function guardarArchivo($nombre, $apellido1, $apellido2, $nacimiento, $localidad) {
                $file = fopen("alumnos1.txt", "a");
                fwrite($file, "$nombre$apellido1$apellido2$nacimiento$localidad" . PHP_EOL);
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