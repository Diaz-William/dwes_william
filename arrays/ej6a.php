<!DOCTYPE html>
<html>
    <head>
        <title>Ej6_Arrays</title>
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
            $i = 0;


            $arrayA = array_merge($array1, $array2, $array3);

            if (in_array("Mecanizado",$arrayA))
            {
                $i = array_search("Mecanizado",$arrayA);
                unset($arrayA[$i]);
            }

            foreach ($arrayA as $x) {
                print($x . "<br>");
            }
        ?>
    </body>
</html>