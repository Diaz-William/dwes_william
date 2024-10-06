<!DOCTYPE html>
<html>
    <head>
        <title>Ej1_Arrays_Multidimensinales</title>
    </head>
    <style>
        table, th, td {
            border: 1px solid black;
        }
    </style>
    <body>
        <?php
            $array = array();
            $multiplo = 0;

            for ($i = 0; $i < 3; $i++) {
                $array[$i] = array();
                for ($j = 0; $j < 3; $j++) {
                    $multiplo += 2;
                    $array[$i][$j] = $multiplo;
                }
            }

            echo "<table>";

            foreach ($array as $fila) {
                echo "<tr>";
                foreach ($fila as $columna) {
                    echo "<td>";
                    echo $columna;
                    echo "</td>";
                }
                echo "</tr>";
            }

            echo "</table>";
        ?>
    </body>
</html>
