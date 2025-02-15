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
        <title>Historial de Descargas - Música</title>
        <link rel="stylesheet" href="../views/css/bootstrap.min.css">
    </head>
    <body>

        <div class="container">
            <h1 class="text-center mt-4">Música</h1>

            <div class="card border-success mb-3 mx-auto <?php echo !empty($downloads) ? 'w-100' : 'w-50'; ?>">
                <div class="card-header text-center">Historial de Descargas</div>
                <div class="card-body">
                    <form action="" method="post">
                        <label for="fechadesde">Fecha Desde:</label>
                        <input type='date' name='fechadesde' value='' class="form-control">
                        <label for="fechahasta">Fecha Hasta:</label>
                        <input type='date' name='fechahasta' value='' class="form-control">

                        <?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["fechadesde"]) && !empty($_POST["fechahasta"])) {
                                if (!empty($downloads)) {
                                    echo '<table class="table table-bordered table-striped mt-3">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Autor</th>
                                                    <th>Fecha Descarga</th>
                                                    <th>Cantidad</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
                                    
                                    foreach ($downloads as $download) {
                                        echo '<tr>
                                                <td>' . htmlspecialchars(mb_convert_encoding($download['Name'], 'UTF-8', 'ISO-8859-1'), ENT_QUOTES, 'UTF-8') . '</td>
                                                <td>' . htmlspecialchars(mb_convert_encoding($download['Composer'], 'UTF-8', 'ISO-8859-1'), ENT_QUOTES, 'UTF-8') . '</td>
                                                <td>' . htmlspecialchars(mb_convert_encoding($download['InvoiceDate'], 'UTF-8', 'ISO-8859-1'), ENT_QUOTES, 'UTF-8') . '</td>
                                                <td>' . $download['Quantity'] . '</td>
                                            </tr>';
                                    }
                                    echo '</tbody></table>';
                                }
                            }
                        ?>

                        <div class="d-grid gap-2 mt-3">
                            <input type="submit" name="consult" value="Consultar" class="btn btn-warning">
                            <button type="button" class="btn btn-warning" onclick="window.location.href='welcome_controller.php'">Volver</button>
                        </div>

                        <div class="mt-3">
                            <?php
                                if ($_SERVER["REQUEST_METHOD"] == "POST" && (empty($_POST["fechadesde"]) || empty($_POST["fechahasta"]))) {
                                    echo "<p class='text-center text-danger mt-3'>Tiene que seleccionar ambas fechas.</p>";
                                }

                                if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["fechadesde"]) && !empty($_POST["fechahasta"])) {
                                    if (empty($downloads)) {
                                        echo "<p class='text-center mt-3'>No hay descargas registradas entre las fechas seleccionadas.</p>";
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