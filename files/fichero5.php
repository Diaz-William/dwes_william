<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>fichero5.php</title>
    </head>
    <body>
    <h1>Operaciones Ficheros</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label>Fichero Path/Nombre</label>
        <input type="text" name="fichero">
        <br><br>
        <input type="radio" name="opcion" value="mostrarFichero">
        <label>Mostrar Fichero</label>
        <br><br>
        <input type="radio" name="opcion" value="mostrarLinea">
        <label>Mostrar linea</label>
        <input type="text" name="num1" size="1">
        <label>fichero</label>
        <br><br>
        <input type="radio" name="opcion" value="mostrarNumLineas">
        <label>Mostrar</label>
        <input type="text" name="num2" size="1">
        <label>primeras lineas</label>
        <br><br>
        <input type="submit" value="Enviar">
        <input type="reset" value="Borrar">
    </form>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $mostrar = test_input($_POST["opcion"]);
            $nombre = test_input($_POST["fichero"]);
            $num = 0;

            if (file_exists($nombre)) {
                echo "<h2>Operaciones Ficheros</h2>";
                $fichero = fopen($nombre, "r") or die("No se ha podido abrir el archivo");
                $datos = file($nombre, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                fclose($fichero);

                switch ($mostrar) {
                    case "mostrarFichero":
                        mostrarFichero($datos);
                        break;
                    case "mostrarLinea":
                        $num = test_input($_POST["num1"]);
                        mostrarLinea($datos, $num);
                        break;
                    case "mostrarNumLineas":
                        $num = test_input($_POST["num2"]);
                        mostrarNumLineas($datos, $num);
                        break;
                }
            }else {
                echo "<p>El archivo no existe</p>";
            }
        }
    ?>

    <?php
        function mostrarFichero($datos) {
            foreach ($datos as $x) {
                echo "$x <br>";
            }
        }

        function mostrarLinea($datos, $num) {
            $linea = $datos[($num - 1)];
            echo "$linea";
        }

        function mostrarNumLineas($datos, $num) {
            $cont = 0;

            while ($cont < $num) {
                echo $datos[$cont] . "<br>";
                $cont += 1;
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