<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>fichero7.php</title>
    </head>
    <body>
    <h1>Operaciones Ficheros</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label>Fichero Origen(Path/Nombre)</label>
        <input type="text" name="origen">
        <br><br>
        <label>Fichero Destino(Path/Nombre)</label>
        <input type="text" name="destino">
        <br><br>
        <label>Operaciones:</label>
        <br><br>
        <input type="radio" name="operacion" value="copiar">
        <label>Copiar Fichero</label>
        <br><br>
        <input type="radio" name="operacion" value="renombrar">
        <label>Renombrar Fichero</label>
        <br><br>
        <input type="radio" name="operacion" value="borrar">
        <label>Borrar Fichero</label>
        <br><br>
        <input type="submit" value="Ejecutar Operación">
        <input type="reset" value="Borrar">
    </form>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $origen = $_POST["origen"];

            if (file_exists($origen)) {
                $operacion = $_POST["operacion"];

                switch ($operacion) {
                    case "copiar":
                        //
                        break;
                    case "renombrar":
                        //
                        break;
                    case "borrar":
                        //
                        break;
                }
            }else {
                echo "<h1>El fichero de origen no existe</h1>";
            }
        }
    ?>
    <?php
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>
    </body>
</html>