<!DOCTYPE html>
<html>
    <head>
        <title>Ej7_Arrays</title>
    </head>
    <body>
        <?php
            $alumnos = array("William" => 7, "Joel" => 8, "Asier" => 6, "Sergio" => 10, "Hugo" => 5);

            // array_search(), busca un valor determinado en un array y devuelve la primera clave correspondiente en caso de éxito
            // max(), encuentra el valor más alto del array
            $nombre = array_search(max($alumnos), $alumnos);
            echo "$nombre tiene la mayor nota.<br><br>";

            // min(), encuentra el valor más bajo del array
            $nombre = array_search(min($alumnos), $alumnos);
            echo "$nombre tiene la menor nota.<br><br>";

            // array_sum(), suma todos los valores de un array
            $media = (array_sum($alumnos) / count($alumnos));
            echo "La media de las notas es $media";
        ?>
    </body>
</html>