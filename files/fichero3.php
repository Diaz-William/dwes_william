<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>fichero3.php</title>
    </head>
    <body>
    <h1>Datos Alumnos</h1>
    <?php
        imprimir();
        
        function imprimir() {
            $fichero = fopen("alumnos1.txt", "r") or die("No se ha podido abrir el archivo");
            $datos = array();
            $datos = explode(" ", $fichero);
            
            /*while(!feof($fichero)) {
                echo fgets($fichero);
            }*/

            echo "<pre>";
            echo print_r( $datos );
            echo "</pre>";
            
            fclose($fichero);
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