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
            $array = array();
            $i = 0;//indice

            while ($i < 20) {
                $array[] = decbin($i);
                $i += 1;
            }

            $i = 0;

            print("<table>");
            print("<tr><th>Indice</th><th>Binario</th><th>Octal</th></tr>");
            foreach ($array as $x) {
                print("<tr>");
                print("<td>" . $i ."</td>");
                print("<td>" . $x ."</td>");
                print("<td>" . decoct($i) ."</td>");
                print("</tr>");
                $i += 1;
            }
            print("</table>");
        ?>
    </body>
</html>