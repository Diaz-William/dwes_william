<!DOCTYPE html>
<html>
    <head>
        <title>Ej4_Arrays</title>
        <style>
            table, th, td {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        <?php
            $array;
            $arrayInverso;

            for ($i = 0; $i < 20; $i++) {
                $array[$i] = decbin($i);
            }

            print("<table>");
            print("<tr><th>Indice</th><th>Binario</th><th>Octal</th></tr>");
            for ($i = 0; $i < count($array); $i++) { 
                print("<tr>");
                print("<td>" . $i ."</td>");
                print("<td>" . $array[$i] ."</td>");
                print("<td>" . decoct($i) ."</td>");
                print("</tr>");
            }
            print("</table>");

            $arrayInverso = array_reverse($array);

            print("<table>");
            print("<tr><th>Indice</th><th>Binario</th><th>Octal</th></tr>");
            for ($i = 0; $i < count($arrayInverso); $i++) { 
                print("<tr>");
                print("<td>" . $i ."</td>");
                print("<td>" . $arrayInverso[$i] ."</td>");
                print("<td>" . decoct(bindec($arrayInverso[$i])) ."</td>");
                print("</tr>");
            }
            print("</table>");
        ?>
    </body>
</html>