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
		<div class="card-header">Menú Usuario - ALQUILAR VEHÍCULOS</div>
		<div class="card-body">
	  	  

	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">
		<?php list($usuario, $id) = explode("#", $_COOKIE["datos"]) ?>
		<B>Bienvenido/a:</B> <?php echo $usuario ?> <BR><BR>
		<B>Identificador Cliente:</B> <?php echo $id ?> <BR><BR>
		
		<B>Vehiculos disponibles en este momento:</B>  <BR><BR>
		
			<B>Matricula/Marca/Modelo: </B>
			<select name="vehiculos" class="form-control">
				<option value="">-- Seleccionar Vehículo --</option>
				<?php
					foreach ($vehiculos as $vehiculo) {
						echo "<option value='{$vehiculo['MATRICULA']}#{$vehiculo['MARCA']}#{$vehiculo['MODELO']}'>{$vehiculo['MATRICULA']} | {$vehiculo['MARCA']} | {$vehiculo['MODELO']}</option>";
					}
				?>
			</select>
			<br><br>
			
			<?php imprimirCesta(); ?>
		
		<BR> <BR><BR><BR><BR><BR>
		<div>
			<input type="submit" value="Agregar a Cesta" name="agregar" class="btn btn-warning disabled">
			<input type="submit" value="Realizar Alquiler" name="alquilar" class="btn btn-warning disabled">
			<input type="submit" value="Vaciar Cesta" name="vaciar" class="btn btn-warning disabled">
		</div>
		<BR><a href="./logout_controller.php">Cerrar Sesión</a>
	</form>
	<!-- FIN DEL FORMULARIO -->
  </body>
   
</html>

