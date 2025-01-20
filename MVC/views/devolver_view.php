<html>
   
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Bienvenido a MovilMAD</title>
    <link rel="stylesheet" href="../views/css/bootstrap.min.css">
  </head>
   
  <body>
    <h1>Servicio de ALQUILER DE E-CARS</h1> 

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Menú Usuario - DEVOLUCIÓN VEHÍCULO </div>
		<div class="card-body">
	  
	   

	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">
		<?php list($usuario, $id) = explode("#", $_COOKIE["datos"]) ?>
		<B>Bienvenido/a:</B> <?php echo $usuario ?> <BR><BR>
		<B>Identificador Cliente:</B> <?php echo $id ?> <BR><BR>
				
			<B>Matricula/Marca/Modelo: </B><select name="vehiculos" class="form-control">
			<option value="">-- Seleccionar Vehículo --</option>
				<?php
					foreach ($alquilados as $alquilado) {
						echo "<option value='{$alquilado['MATRICULA']}#{$alquilado['MARCA']}#{$alquilado['MODELO']}'>{$alquilado['MATRICULA']} | {$alquilado['MARCA']} | {$alquilado['MODELO']}</option>";
					}
				?>
			</select>
		<BR><BR>
		<div>
			<input type="submit" value="Devolver Vehiculo" name="devolver" class="btn btn-warning disabled">
			<input type="button" value="Volver" name="Volver" class="btn btn-warning disabled" onclick="window.location.href='welcome_controller.php'">
		</div>
	</form>

	<?php
		if ($pagar) {
			echo "<form action='https://sis-t.redsys.es:25443/sis/realizarPago' method='post'>
					<input type='hidden' name='Ds_SignatureVersion' value='".$version."'/>
					<input type='hidden' name='Ds_MerchantParameters' value='".$params."'/>
					<input type='hidden' name='Ds_Signature' value='".$signature."'/>
					<input type='submit' name='pagar' id='pagar' value='Pagar'>
				</form>";
		}
	?>
	<!-- FIN DEL FORMULARIO -->
	<a href="./logout_controller.php">Cerrar Sesión</a><br><br>
	
  </body>
   
</html>



