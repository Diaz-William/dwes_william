<!DOCTYPE html>
<html>
    <head>
        <title>Ej2_Arrays</title>
        <style>
            table, th, td {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        <?php
            $array = array();
            $suma = 0;
            $impar = 0;
            $cont = 0;
            $mediaPar = 0;
            $mediaImpar = 0;
            

            while (count($array) < 20) {
                $impar += 1;
                if ($impar % 2 == 1) {
                    $array[] = $impar;
                }
            }

            print("<table>");
            print("<tr><th>Indice</th><th>Valor</th><th>Suma</th></tr>");
            foreach ($array as $x) {
                print("<tr>");
                print("<td>" . $i ."</td>");
                print("<td>" . $x ."</td>");
                $suma += $x;
                print("<td>" . $suma ."</td>");
                print("</tr>");
                $i += 1;
            }
            print("</table>");

            $i = 0;
            foreach ($array as $x) {
                if ($i % 2 == 0) {
                    $cont += 1;
                    $mediaPar += $x;
                }
                $i += 1;
            }

            $mediaPar /= $cont;
            $cont = 0;
            $i = 0;

            foreach ($array as $x) {
                if ($i % 2 == 1) {
                    $cont += 1;
                    $mediaImpar += $x;
                }
                $i += 1;
            }

            $mediaImpar /= $cont;

            print("<p>La media de los valores en la posición par es --> " . $mediaPar . "</p>");
            print("<p>La media de los valores en la posición impar es --> " . $mediaImpar . "</p>");
        ?>
    </body>
</html>