<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>basen.php</title>
    </head>
    <body>
        <h1>Cambio de Base</h1>
        <?php
            $num = $baseA = $baseB = 0;
            $datos = array();

            $datos = explode("/", $_REQUEST["convertir"]);
            $num = test_input($datos[0]);
            $baseA = test_input($datos[1]);
            $baseB = test_input($_REQUEST["base"]);

            function convertir($num, $baseA, $baseB) {
                return base_convert($num, $baseA, $baseB);
            }

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
        ?>
    </body>
</html>