<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
            table, th, td {
                border:1px solid black;
            }
        </style>
    </head>
    <body>
        <h1>Reto 02 - Gestión Ficheros</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="opcion">Elije una opción:</label>
            <select id="opcion" name="opcion">
                <option value="tiempo">Tiempo</option>
                <option value="censo">Censo</option>
            </select>
            <br><br>
            <input type="submit" value="Visualizar">
        </form>
        <?php
            include 'funciones.php';
            include 'errores_sistema.php';
            set_error_handler("error_function");

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (test_input($_POST["opcion"]) == "tiempo") {
                    $xml1 = obtenerXML("pronosticotiempoLasRozas.xml");
                    $xml2 = obtenerXML("pronosticotiempoMadrid.xml");

                    imprimirTablaXml($xml1);
                    imprimirTablaXml($xml2);
                }else {
                    $censoCsv = obtenerDatos("CensoProvinciaHombresMujeres.csv");
                    imprimirTablaCsv($censoCsv);

                    $censoTxt = obtenerDatos("CensoProvinciaHombresMujeres.txt");
                    imprimirTablaTxt($censoTxt);
                }
            }
        ?>
    </body>
</html>