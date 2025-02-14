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
        <h1 class="text-center mt-4">Historial de Facturas</h1>

        <div class="card border-success mb-3 mx-auto">
            <div class="card-header text-center">Facturas</div>
            <div class="card-body">
                <?php if (!empty($invoices)): ?>
                    <table class="table table-bordered table-striped">
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
                        <tbody>
                            <?php foreach ($invoices as $invoice): ?>
                                <tr>
                                    <td><?= htmlspecialchars($invoice['InvoiceId']) ?></td>
                                    <td><?= htmlspecialchars($invoice['InvoiceDate']) ?></td>
                                    <td><?= htmlspecialchars($invoice['BillingAddress']) ?></td>
                                    <td><?= htmlspecialchars($invoice['BillingCity']) ?></td>
                                    <td><?= htmlspecialchars($invoice['BillingState'] ?? 'N/A') ?></td>
                                    <td><?= htmlspecialchars($invoice['BillingCountry']) ?></td>
                                    <td><?= htmlspecialchars($invoice['BillingPostalCode']) ?></td>
                                    <td>$<?= htmlspecialchars(number_format($invoice['Total'], 2)) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-center">No hay facturas registradas.</p>
                <?php endif; ?>

                <div class="d-grid gap-2 mt-3">
                    <button type="button" class="btn btn-warning" onclick="window.location.href='welcome_controller.php'">Volver</button>
                </div>

                <div class="text-center mt-3">
                    <a href="./logout_controller.php">Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>