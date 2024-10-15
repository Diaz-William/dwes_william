<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>fichero4.php</title>
    </head>
    <body>
    <h1>Operaciones Ficheros</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label>Fichero Path/Nombre</label>
        <input type="text" name="fichero">
        <br><br>
        <input type="radio" name="opcion" value="MostrarFichero">
        <label>Mostrar Fichero</label>
        <br><br>
        <input type="radio" name="opcion" value="MostrarLinea">
        <label>Mostrar linea</label>
        <input type="text" name="num" size="1">
        <label>fichero</label>
        <br><br>
        <input type="radio" name="opcion" value="MostrarNumLineas">
        <label>Mostrar</label>
        <input type="text" name="num" size="1">
        <label>primeras lineas</label>
        <br><br>
        <input type="submit" value="Enviar">
        <input type="reset" value="Borrar">
    </form>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fichero = fopen("quijote.txt", "r") or die("No se ha podido abrir el archivo");
            $datos = file("quijote.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            fclose($fichero);

            echo "<pre>";
            echo print_r( $datos );
            echo "</pre>";
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