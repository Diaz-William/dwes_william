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
        <title>Descargar - Música</title>
        <link rel="stylesheet" href="../views/css/bootstrap.min.css">
    </head>
    <body>

        <div class="container">
            <h1 class="text-center mt-4">Música</h1>

            <!-- Aplicación -->
            <div class="card border-success mb-3 mx-auto" style="max-width: 30rem;">
                <div class="card-header text-center">Descargar Música</div>
                <div class="card-body">
                    <form action="" method="post">
                        <label for="trackinfo"><b>Canciones</b>:</label>
                        <select name="trackinfo" id="trackinfo" class="form-control">
                            <option value="">-- Seleccionar Canción --</option>
                            <?php
                                if (isset($tracks) && is_array($tracks)) {
                                    foreach ($tracks as $track) {
                                        echo "<option value='{$track['TrackId']}#{$track['Name']}#{$track['Composer']}#{$track['UnitPrice']}'>{$track['Name']} - {$track['Composer']} - $ {$track['UnitPrice']}</option>";
                                    }
                                }
                            ?>
                        </select>

                        <div class="d-grid gap-2 mt-3">
                            <input type="submit" name="add" value="Añadir" class="btn btn-warning">
                            <input type="submit" name="download" value="Descargar" class="btn btn-warning">
                            <button type="button" class="btn btn-warning" onclick="window.location.href='welcome_controller.php'">Volver</button>
                        </div>

                        <div class="mt-3">
                            <?php
                                if (isset($_COOKIE["basketTracks"])) {
                                    $basketTracks = unserialize($_COOKIE["basketTracks"]);
                                    $count = is_array($basketTracks) ? count($basketTracks) : 0;
                                    echo "<p>Hay <strong>$count</strong> canciones en la cesta.</p>";
                                }

                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    if (isset($_POST["add"]) && empty($_POST["trackinfo"])) {
                                        echo "<p class='text-danger'>Tiene que seleccionar una canción.</p>";
                                    }
    
                                    if (isset($_POST["add"]) && !empty($_POST["trackinfo"]) && !$added) {
                                        echo "<p class='text-danger'>Ha ocurrido un error. Inténtelo más tarde.</p>";
                                    }

                                    if (isset($_POST["download"]) && !isset($_COOKIE["basketTracks"])) {
                                        echo "<p class='text-danger'>Tiene que añadir canciones a la cesta para realizar la compra.</p>";
                                    }
                                }
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