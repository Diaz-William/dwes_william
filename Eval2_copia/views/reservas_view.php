<?php
    if (!isset($_COOKIE["usuario"])) {
        header("Location: ../index.php");
        exit;
    }
?>

<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>RESERVAS VUELOS</title>
    <link rel="stylesheet" href="../views/css/bootstrap.min.css">
 </head>
   
 <body>
   

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Reservar Vuelos</div>
		<div class="card-body">
	  	  

	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">
		<?php
			list($fullname, $email) = explode("#", $_COOKIE["usuario"]);
			date_default_timezone_set('Europe/Madrid');
            $date = date("d-m-Y");
		?>

		<B>Email Cliente:</B> <?php echo $email ?> <BR>
		<B>Nombre Cliente:</B> <?php echo $fullname ?> <BR>
		<B>Fecha:</B> <?php echo $date ?> <BR><BR>
		
		<B>Vuelos</B>
		<select name="vuelos" class="form-control">
			<option value="">-- Seleccionar Vuelo --</option>
			<?php
				if (isset($vuelos) && is_array($vuelos)) {
					foreach ($vuelos as $vuelo) {
						echo "<option value='{$vuelo['id_vuelo']}#{$vuelo['origen']};{$vuelo['fechahorasalida']};{$vuelo['destino']};{$vuelo['fechahorallegada']};{$vuelo['precio_asiento']}'>{$vuelo['origen']} - {$vuelo['fechahorasalida']} - {$vuelo['destino']} - {$vuelo['fechahorallegada']} - {$vuelo['precio_asiento']}</option>";
					}
				}
			?>	
		</select>	
		<BR> 
		<B>Número Asientos</B><input type="number" name="asientos" size="3" min="1" max="100" value="1" class="form-control">
		<BR><BR><BR><BR><BR>
		<div>
			<input type="submit" value="Agregar a Cesta" name="agregar" class="btn btn-warning disabled">
			<input type="submit" value="Comprar" name="comprar" class="btn btn-warning disabled">
			<input type="submit" value="Vaciar Cesta" name="vaciar" class="btn btn-warning disabled">
			<input type="submit" value="Volver" name="volver" class="btn btn-warning disabled">
		</div>
		
		<div class="mt-3">
			<?php
				if (isset($_COOKIE["cesta"])) {
					$cesta = unserialize($_COOKIE["cesta"]);
					if ($cesta !== false) {
						echo "<ul>";
						foreach ($cesta as $id_vuelo => $datos) {
							list($origen, $salida, $destino, $llegada, $precio, $asientos) = explode(";", $datos);
							echo "<li>$origen - $salida - $destino - $llegada - $precio - $asientos</li>";
						}
						echo "</ul>";
					}
				}

				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					if (isset($_POST["agregar"]) && empty($_POST["vuelos"])) {
						echo "<p class='text-center text-danger mt-3'>Tiene que seleccionar un vuelo.</p>";
					}

					if (isset($_POST["agregar"]) && !empty($_POST["vuelos"]) && !$added) {
						echo "<p class='text-center text-danger mt-3'>Ha ocurrido un error. Inténtelo más tarde.</p>";
					}

					if (isset($_POST["comprar"]) && !isset($_COOKIE["cesta"])) {
						echo "<p class='text-center text-danger mt-3'>Tiene que añadir vuelos a la cesta para realizar la compra.</p>";
					}
				}
			?>
		</div>
	</form>
	
	<!-- FIN DEL FORMULARIO -->
	<div class="text-center mt-3">
		<a href="./loguot_controller.php">Cerrar Sesión</a>
	</div>
  </body>
   
</html>

