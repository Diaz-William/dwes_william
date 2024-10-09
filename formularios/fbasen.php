<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>basen.html</title>
    </head>
    <body>
        <h1>Cambio de Base</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label>Número</label>
            <input type="text" name="convertir">
            <br><br>
            <label>Nueva Base</label>
            <input type="text" name="base"><br><br>
            <input type="submit" value="Cambio Base">
            <input type="reset" value="Borrar">
        </form>
        <?php
            $num = $baseA = $baseB = $convertido = 0;
            $datos = array();

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $datos = explode("/", $_REQUEST["convertir"]);
                $num = intval(test_input($datos[0]));
                $baseA = intval(test_input($datos[1]));
                $baseB = intval(test_input($_REQUEST["base"]));

                $convertido = convertir($num, $baseA, $baseB);

                echo "<p>Número $num en base $baseA = $convertido en base $baseB</p>";
            }

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