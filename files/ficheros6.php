<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>fichero6.php</title>
    </head>
    <body>
    <h1>Operaciones Ficheros</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label>Fichero Path/Nombre</label>
        <input type="text" name="fichero">
        <br><br>
        <input type="submit" value="Ver Datos Fichero">
        <input type="reset" value="Borrar">
    </form>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fichero = $_POST["fichero"];

            if (file_exists($fichero)) {
                $datos = explode("\\", $fichero);
                $nombre = $datos[(count($datos) -1)];
                $ruta = dirname(realpath($fichero));
                $tamanio = filesize($fichero);
                $modificacion = date("d/M/Y H:i:s.", filectime($fichero));
                imprimir($nombre, $ruta, $tamanio, $modificacion);
            }else {
                echo "<p>El archivo no existe</p>";
            }
        }

        function imprimir($nombre, $ruta, $tamanio, $modificacion) {
            echo "<h2>Operaciones Ficheros</h2>";
            echo "<p>Nombre del fichero: $nombre</p>";
            echo "<p>Directorio: $ruta</p>";
            echo "<p>Tamaño del fichero: $tamanio bytes</p>";
            echo "<p>Fecha última modificación fichero: $modificacion</p>";
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