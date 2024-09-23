<!DOCTYPE html>
<html>
    <head>
        <title>Ej5_Arrays</title>
        <style>
            table, th, td {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        <?php
            $array1 = array("Bases de Datos", "Entornos Desarrollo", "Programción");
            $array2 = array("Sistemas Informáticos", "FOL", "Mecanizado");
            $array3 = array("Desarrollo Web ES", "Desarrollo Web EC", "Despliegue", "Desarrollo Interfaces", "Inglés");
            $arrayA = array();
            $arrayB = array();
            $arrayC = array();
            $i = 0;

            while ($i < count($array1)) {
                $arrayA[] = $array1[$i];
                $i += 1;
            }

            $i = 0;

            while ($i < count($array2)) {
                $arrayA[] = $array2[$i];
                $i += 1;
            }

            $i = 0;

            while ($i < count($array3)) {
                $arrayA[] = $array3[$i];
                $i += 1;
            }

            $i = 0;

            foreach ($arrayA as $x) {
                print($x . "<br>");
            }

            print("<br>");

            //--------------------------------------------------------------------------

            $arrayB = array_merge($array1, $array2, $array3);

            foreach ($arrayB as $x) {
                print($x . "<br>");
            }

            print("<br>");

            //--------------------------------------------------------------------------

            foreach ($array1 as $x) {
                array_push($arrayC, $x);
            }

            foreach ($array2 as $x) {
                array_push($arrayC, $x);
            }

            foreach ($array3 as $x) {
                array_push($arrayC, $x);
            }

            foreach ($arrayC as $x) {
                print($x . "<br>");
            }
        ?>
    </body>
</html>