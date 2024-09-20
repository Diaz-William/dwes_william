<!DOCTYPE html>
<html>
    <head>
        <title>Ej1_Arrays</title>
        <style>
            table, th, td {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        <?php
            $array;
            $suma = 0;
            $impar = 0;
            

            while (count($array) < 20) {
                $impar += 1;
                if ($impar % 2 == 1) {
                    $array[] = $impar;
                }
            }

            print("<table>");
            print("<tr><th>Indice</th><th>Valor</th><th>Suma</th></tr>");
            for ($i = 0; $i < count($array); $i++) { 
                print("<tr>");
                print("<td>" . $i ."</td>");
                print("<td>" . $array[$i] ."</td>");
                $suma += $array[$i];
                print("<td>" . $suma ."</td>");
                print("</tr>");
            }
            print("</table>");
        ?>
    </body>
</html>