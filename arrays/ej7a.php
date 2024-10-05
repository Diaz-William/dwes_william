<!DOCTYPE html>
<html>
    <head>
        <title>Ej7_Arrays</title>
    </head>
    <body>
        <?php
            $alumnos = array("William" => 21, "Joel" => 19, "Asier" => 19, "Sergio" => 18, "Hugo" => 21);

            foreach ($alumnos as $alumno => $edad) {
                echo "Nombre --> $alumno // edad --> $edad <br><br>";
            }

            echo "Segunda posición:<br><br>";
            reset($alumnos); // reset(), coloca el puntero del array a su primer elemente
            next($alumnos); // next(), avanza la posición del puntero una vez
            echo "Nombre --> " . key($alumnos) . " // " . "edad --> " . current($alumnos) . "<br><br>"; // key(), devuela la clave de la posición del puntero // current(), devuelve el valor de la posición del puntero

            echo "Tercera posición:<br><br>";
            next($alumnos);
            echo "Nombre --> " . key($alumnos) . " // " . "edad --> " . current($alumnos) . "<br><br>";

            echo "Última posición:<br><br>";
            end($alumnos); // end(), coloca el puntero en la última posición del array
            echo "Nombre --> " . key($alumnos) . " // " . "edad --> " . current($alumnos) . "<br><br>";

            echo "Primera posición ordenada:<br><br>";
            asort($alumnos); // asort(), ordena un array asociativo en orden ascendente y mantiene la asociación entre las claves y sus valores
            reset($alumnos);
            echo "Nombre --> " . key($alumnos) . " // " . "edad --> " . current($alumnos) . "<br><br>";

            echo "Última posición ordenada:<br><br>";
            end($alumnos);
            echo "Nombre --> " . key($alumnos) . " // " . "edad --> " . current($alumnos) . "<br><br>";
        ?>
    </body>
</html>