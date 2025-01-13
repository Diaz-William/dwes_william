<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Listado Alquileres</title>
    </head>
    <body>
        <h1>Listado Alquileres</h1>
        <?php
            // Solo muestra datos no accede a los mismos
            foreach ($datos as $dato) {
                echo $dato["title"]."<br/>";
            }
        ?>
    </body>
</html>