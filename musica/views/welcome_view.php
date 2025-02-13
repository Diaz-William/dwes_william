<?php
    if (!isset($_COOKIE["usuario"])) {
        header("Location: ../index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Bienvenido a Música</title>
        <link rel="stylesheet" href="../views/css/bootstrap.min.css">
    </head>
    <body>

        <div class="container">
            <h1 class="text-center mt-4">Música</h1> 

            <!-- Aplicación -->
            <div class="card border-success mb-3 mx-auto" style="max-width: 30rem;">
                <div class="card-header text-center">Menú Empleado - OPERACIONES</div>
                <div class="card-body">

                    <?php list($fullname, $id) = explode("#", $_COOKIE["usuario"]); ?>

                    <p class="mb-3"><strong>Bienvenido/a:</strong> <?php echo $fullname; ?></p>
                    <p class="mb-3"><strong>ID de usuario:</strong> <?php echo $id; ?></p>

                    <!-- Formulario con botones -->
                    <div class="d-grid gap-2">
                        <button class="btn btn-warning" onclick="window.location.href='nomina_controller.php'">Descargar</button>
                        <button class="btn btn-warning" onclick="window.location.href='histLab_controller.php'">Historial Facturas</button>
                        <button class="btn btn-warning" onclick="window.location.href='histLab_controller.php'">Seleccionar Facturas</button>
                        <button class="btn btn-warning" onclick="window.location.href='histLab_controller.php'">Seleccionar Descargas</button>
                    </div>

                    <div class="text-center mt-3">
                        <a href="./logout_controller.php">Cerrar Sesión</a>
                    </div>

                </div>  
            </div>
        </div>

    </body>
</html>