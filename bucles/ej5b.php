<!DOCTYPE html>
<html>
    <head>
        <title>EJ5B - Tabla Multiplicar con TD</title>
        <style>
        	table, td {
              border: 1px solid black;
            }
        </style>
    </head>
    <body>
        <?php
            $num = "8";
            
            print("<table>");
            for ($i = 1; $i <= 10; $i++) {
            	$aux = $num * $i;
                print("<tr>");
            	print("<td>" . $num . " x " . $i . "</td>");
                print("<td>" . $aux . "</td>");
                print("</tr>");
                
            }
            print("</table>");
        ?>
    </body>
</html>