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
            $arrayFilas = array();
            $arrayColumnas = array();
            $multiplo = 0;
            $suma = 0;

            for ($i = 0; $i < 3; $i++) {
                $array[$i] = array();
                for ($j = 0; $j < 3; $j++) {
                    $multiplo += 2;
                    $array[$i][$j] = $multiplo;
                }
            }

            foreach ($array as $fila) {
                $suma = 0;
                foreach ($fila as $columna) {
                    $suma += $columna;
                }
                $arrayFilas[] = $suma;
            }

            for ($i = 0; $i < count($array); $i++) {
                $suma = 0;
                for ($j = 0; $j < count($array[0]); $j++) {
                    $suma += $array[$j][$i];
                }
                $arrayColumnas[] = $suma;
            }

            echo "Suma de las filas<br><br>";
            echo "<table>";
            foreach ($arrayFilas as $x) {
                echo "<tr>";
                    echo "<td>";
                    echo $x;
                    echo "</td>";
                echo "</tr>";
            }
            echo "</table><br><br>";

            echo "Suma de las columnas<br><br>";
            echo "<table>";
            echo "<tr>";
            foreach ($arrayColumnas as $x) {
                echo "<td>";
                echo $x;
                echo "</td>";
            }
            echo "</tr>";
            echo "</table>";
        ?>
    </body>
</html>
