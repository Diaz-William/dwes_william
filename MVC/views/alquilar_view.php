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
		
		<B>Vehiculos disponibles en este momento:</B> <?php echo date("d/m/Y H:i"); ?> <BR><BR>
		
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

			<?php
				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					if (isset($_POST["agregar"]) && empty($_POST["vehiculos"])) {
						echo "Debe seleccionar un vehículo.";
					} else if (isset($_POST["agregar"]) && isset($auxAgregar) && !$auxAgregar) {
						echo "No puede seleccionar más de 3 vehículos.";
					} else if (isset($_POST["alquilar"]) && !isset($_COOKIE["cesta"]) || isset($_POST["alquilar"]) && !isset($_COOKIE["cesta"]) && isset($auxAlquilar) && $auxAlquilar) {
						echo "Debe añadir vehículos a la cesta.";
					} else if (isset($auxAlquilar) && $auxAlquilar) {
						echo "El alquiler se ha realizado correctamente.";
					} else if (isset($auxAlquilar) && !$auxAlquilar && $alquilados >= 3) {
						echo "Ya tiene 3 vehículos alquilados.";
					} else if (isset($auxAlquilar) && !$auxAlquilar) {
						$maxDisponibles = 3 - $alquilados;
						echo "Tiene $alquilados vehículos alquilados, solo puede alquilar $maxDisponibles vehículos.";
					}
				}
			?>
		
		<BR> <BR><BR><BR><BR><BR>
		<div>
			<input type="submit" value="Agregar a Cesta" name="agregar" class="btn btn-warning disabled">
			<input type="submit" value="Realizar Alquiler" name="alquilar" class="btn btn-warning disabled">
			<input type="submit" value="Vaciar Cesta" name="vaciar" class="btn btn-warning disabled">
			<input type="button" value="Volver" name="Volver" class="btn btn-warning disabled" onclick="window.location.href='welcome_controller.php'">
		</div>
		<BR><a href="./logout_controller.php">Cerrar Sesión</a>
	</form>
	<!-- FIN DEL FORMULARIO -->
  </body>
   
</html>

