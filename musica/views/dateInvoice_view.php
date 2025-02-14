<div class="container">
    <h1 class="text-center mt-4">Música</h1>

    <div class="card border-success mb-3 mx-auto <?php echo !empty($invoices) ? 'w-100' : 'w-50'; ?>">
        <div class="card-header text-center">Historial de Facturas</div>
        <div class="card-body">
            <form action="" method="post">
                <label for="fechadesde">Fecha Desde:</label>
                <input type='date' name='fechadesde' value='' class="form-control">
                <label for="fechahasta">Fecha Hasta:</label>
                <input type='date' name='fechahasta' value='' class="form-control">

                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["fechadesde"]) && !empty($_POST["fechahasta"])) {
                        if (!empty($invoices)) {
                            echo '<table class="table table-bordered table-striped mt-3">
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
                                        <td>' . htmlspecialchars($invoice['InvoiceId'], ENT_QUOTES, 'UTF-8') . '</td>
                                        <td>' . htmlspecialchars($invoice['InvoiceDate'], ENT_QUOTES, 'UTF-8') . '</td>
                                        <td>' . htmlspecialchars($invoice['BillingAddress'], ENT_QUOTES, 'UTF-8') . '</td>
                                        <td>' . htmlspecialchars($invoice['BillingCity'], ENT_QUOTES, 'UTF-8') . '</td>
                                        <td>' . htmlspecialchars($invoice['BillingState'] ?? 'N/A', ENT_QUOTES, 'UTF-8') . '</td>
                                        <td>' . htmlspecialchars($invoice['BillingCountry'], ENT_QUOTES, 'UTF-8') . '</td>
                                        <td>' . htmlspecialchars($invoice['BillingPostalCode'], ENT_QUOTES, 'UTF-8') . '</td>
                                        <td>$' . number_format((float)$invoice['Total'], 2) . '</td>
                                    </tr>';
                            }
                            echo '</tbody></table>';
                        } else {
                            echo '<p class="text-center text-danger mt-3">No hay facturas registradas entre las fechas seleccionadas.</p>';
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
                            echo "<p class='text-center text-danger'>Tiene que seleccionar ambas fechas.</p>";
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