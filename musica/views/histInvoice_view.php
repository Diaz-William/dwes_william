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
        <title>Historial Facturas - Música</title>
        <link rel="stylesheet" href="../views/css/bootstrap.min.css">
    </head>
    <body>

        <div class="container">
            <h1 class="text-center mt-4">Música</h1>

            <!-- Aplicación -->
            <div class="card border-success mb-3 mx-auto" style="max-width: 30rem;">
                <div class="card-header text-center">Historial Facturas</div>
                <div class="card-body">
                    <form action="" method="post">
                        <h5>Facturas:</h5>
                        <?php
                            var_dump($invoices);
                        ?>

                        <div class="d-grid gap-2 mt-3">
                            <button type="button" class="btn btn-warning" onclick="window.location.href='welcome_controller.php'">Volver</button>
                        </div>

                        <div class="mt-3">
                            <?php
                                //code...
                            ?>
                        </div>

                        <div class="text-center mt-3">
                            <a href="./logout_controller.php">Cerrar Sesión</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </body>
</html>