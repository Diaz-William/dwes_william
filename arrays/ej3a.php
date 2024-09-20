<!DOCTYPE html>
<html>
    <head>
        <title>Ej3_Arrays</title>
        <style>
            table, th, td {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        <?php
            $array;

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
        ?>
    </body>
</html>