<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>fip.php</title>
    </head>
    <body>
    <h1>IPs</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label>IP notación decimal</label>
            <input type="text" name="ip">
            <br><br>
            <input type="submit" value="Notación Binaria">
            <input type="reset" value="Borrar">
        </form>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $ip = "";
                $octetos = array();
                $octeto1 = $octeto2 = $octeto3 = $octeto4 = 0;

                $ip = test_input($_REQUEST["ip"]);

                if (validarIP($ip)) {
                    $octetos = explode(".", $ip);

                    $octeto1 = str_pad(decbin($octetos[0]), 8, "0", STR_PAD_LEFT);
                    $octeto2 = str_pad(decbin($octetos[1]), 8, "0", STR_PAD_LEFT);
                    $octeto3 = str_pad(decbin($octetos[2]), 8, "0", STR_PAD_LEFT);
                    $octeto4 = str_pad(decbin($octetos[3]), 8, "0", STR_PAD_LEFT);

                    $ipBinaria = "$octeto1.$octeto2.$octeto3.$octeto4";
                    echo "<label>IP Binario</label>&nbsp;";
                    echo "<input type='text' name='num' value='$ipBinaria' readonly><br><br>";
                }else {
                    echo "<p>Introduce una IP valida</p>";
                }
            }

            function validarIP($ip) {
                return filter_var($ip, FILTER_VALIDATE_IP);
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