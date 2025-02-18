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
        <title>Comprar - Música</title>
        <link rel="stylesheet" href="../views/css/bootstrap.min.css">
    </head>
    <body>

        <div class="container">
            <h1 class="text-center mt-4">Música</h1>

            <!-- Aplicación -->
            <div class="card border-success mb-3 mx-auto" style="max-width: 30rem;">
                <div class="card-header text-center">Comprar Música</div>
                <div class="card-body">
                    <form action="https://sis-t.redsys.es:25443/sis/realizarPago" method="post">
                        <h5>Canciones en la cesta:</h5>
                        <?php
                            $basketTracks = unserialize($_COOKIE["basketTracks"]);
                            echo "<ul>";
                            foreach ($basketTracks as $trackid => $trackinfo) {
                                list($name, $composer, $unitprice, $quantity) = explode("#", $trackinfo);
                                echo "<li>$name - $composer - $unitprice - $quantity</li>";
                            }
                            echo "</ul>";

                            echo "<p class='text-center mt-3'>Total $$amount</p>";

                            echo "<input type='hidden' name='Ds_SignatureVersion' value='".$version."'/>";
                            echo "<input type='hidden' name='Ds_MerchantParameters' value='".$params."'/>";
                            echo "<input type='hidden' name='Ds_Signature' value='".$signature."'/>";
                        ?>

                        <div class="d-grid gap-2 mt-3">
                            <input type="submit" name="buy" value="Comprar" class="btn btn-warning">
                            <button type="button" class="btn btn-warning" onclick="window.location.href='downloader_controller.php'">Volver</button>
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