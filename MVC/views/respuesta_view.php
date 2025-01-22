<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Respuesta</title>
    <link rel="stylesheet" href="../views/css/bootstrap.min.css">
</head>
<body>
    <h1>Servicio de ALQUILER DE E-CARS</h1> 

    <div class="container">
        <div class="card border-success mb-3" style="max-width: 30rem;">
            <div class="card-header">Menú Usuario - DEVOLUCIÓN VEHÍCULO</div>
            <div class="card-body">
                <!-- Formulario -->
                <form action="" method="post">
                    <?php list($usuario, $id) = explode("#", $_COOKIE["datos"]) ?>
                    <b>Bienvenido/a:</b> <?php echo htmlspecialchars($usuario); ?> <br><br>
                    <b>Identificador Cliente:</b> <?php echo htmlspecialchars($id); ?> <br><br>
                    <br><br>
                    <div>
                        <input type="button" value="Seguir" name="Seguir" class="btn btn-warning" onclick="window.location.href='devolver_controller.php'"><br><br>
                    </div>
                </form>

                <?php
                    list($fecha_devolver, $matricula, $precio, $num_pago) = explode("#", $_COOKIE["datosPago"]);
                    if ($signatureCalculada === $signatureRecibida && $codigoRespuesta >= 0 && $codigoRespuesta < 100) { 
                        echo "El pago se ha realizado correctamente";
                        setcookie("datosPago", "", time() - 86400, "/");
                        actualizarAlquileres($num_pago, $matricula, $fecha_devolver, $precio);
                    } else { 
                        echo "Pendiente de pago $precio €";
                        pendientePago($precio);
                    }
                ?>

                <br><br><a href="./logout_controller.php">Cerrar Sesión</a><br><br>
            </div>
        </div>
    </div>
</body>
</html>