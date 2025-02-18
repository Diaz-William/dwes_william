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
        <title>Respuesta - Música</title>
        <link rel="stylesheet" href="../views/css/bootstrap.min.css">
    </head>
    <body>

        <div class="container">
            <h1 class="text-center mt-4">Música</h1>

            <!-- Aplicación -->
            <div class="card border-success mb-3 mx-auto" style="max-width: 30rem;">
                <div class="card-header text-center">Respuesta Pago Música</div>
                <div class="card-body">
                    <form action="" method="post">

                        <div class="mt-3">
                            <?php
                                if ($signatureCalculada === $signatureRecibida && $codigoRespuesta >= 0 && $codigoRespuesta < 100) { 
                                    echo "<p class='text-center mt-3'>El pago se ha realizado correctamente.</p>";
                                } else {
                                    echo "<p class='text-center text-danger mt-3'>Pendiente de pago $" . ($amount / 100) . ".</p>";
                                }
                            ?>
                        </div>

                        <div class="d-grid gap-2 mt-3">
                            <input type="button" value="Seguir" name="Seguir" class="btn btn-warning" onclick="window.location.href='downloader_controller.php'">
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