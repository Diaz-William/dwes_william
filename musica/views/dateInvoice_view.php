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
    <title>Historial de Facturas - Música</title>
    <link rel="stylesheet" href="../views/css/bootstrap.min.css">
</head>
<body>

<div class="container">
            <h1 class="text-center mt-4">Música</h1>

            <!-- Aplicación -->
            <div class="card border-success mb-3 mx-auto" style="max-width: 30rem;">
                <div class="card-header text-center">Historial de Facturas</div>
                <div class="card-body">
                    <form action="" method="post">
                        <label for="fechadesde">Fecha Desde:</label>
                        <input type='date' name='fechadesde' value='' size=10 placeholder="fechadesde" class="form-control">
                        <label for="fechadesde">Fecha Hasta:</label>
                        <input type='date' name='fechahasta' value='' size=10 placeholder="fechahasta" class="form-control">

                        <?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                if (!empty($_POST["fechadesde"]) && !empty($_POST["fechahasta"])) {
                                    if (!empty($invoices)) {
                                        echo '<table class="table table-bordered table-striped">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>ID Factura</th>
                                                    <th>Fecha</th>
                                                    <th>Dirección</th>
                                                    <th>Ciudad</th>
                                                    <th>Estado</th>
                                                    <th>País</th>
                                                    <th>Código Postal</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>';

                                            foreach ($invoices as $invoice) {
                                                echo '<tr>
                                                    <td>' . htmlspecialchars(mb_convert_encoding($invoice['InvoiceId'], 'UTF-8', 'ISO-8859-1'), ENT_QUOTES, 'UTF-8') . '</td>
                                                    <td>' . htmlspecialchars(mb_convert_encoding($invoice['InvoiceDate'], 'UTF-8', 'ISO-8859-1'), ENT_QUOTES, 'UTF-8') . '</td>
                                                    <td>' . htmlspecialchars(mb_convert_encoding($invoice['BillingAddress'], 'UTF-8', 'ISO-8859-1'), ENT_QUOTES, 'UTF-8') . '</td>
                                                    <td>' . htmlspecialchars(mb_convert_encoding($invoice['BillingCity'], 'UTF-8', 'ISO-8859-1'), ENT_QUOTES, 'UTF-8') . '</td>
                                                    <td>' . htmlspecialchars(mb_convert_encoding($invoice['BillingState'] ?? 'N/A', 'UTF-8', 'ISO-8859-1'), ENT_QUOTES, 'UTF-8') . '</td>
                                                    <td>' . htmlspecialchars(mb_convert_encoding($invoice['BillingCountry'], 'UTF-8', 'ISO-8859-1'), ENT_QUOTES, 'UTF-8') . '</td>
                                                    <td>' . htmlspecialchars(mb_convert_encoding($invoice['BillingPostalCode'], 'UTF-8', 'ISO-8859-1'), ENT_QUOTES, 'UTF-8') . '</td>
                                                    <td>$' . number_format((float)$invoice['Total'], 2) . '</td>
                                                </tr>';
                                            }

                                        echo '</tbody></table>';
                                    } else {
                                        echo '<p class="text-center">No hay facturas registradas entre las fechas seleccionadas.</p>';
                                    }
                                }
                            }
                        ?>

                        <div class="d-grid gap-2 mt-3">
                            <input type="submit" name="consult" value="Consultar" class="btn btn-warning">
                            <button type="button" class="btn btn-warning" onclick="window.location.href='welcome_controller.php'">Volver</button>
                        </div>

                        <div class="mt-3">
                            <?php
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    if (empty($_POST["fechadesde"]) && empty($_POST["fechahasta"])) {
                                        echo "<p class='text-center'>Tiene que seleccionar ambas fechas.</p>";
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