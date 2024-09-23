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
            $array = array();
            $suma = 0;
            $impar = 0;
            $i = 0;//indice
            

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
        ?>
    </body>
</html>