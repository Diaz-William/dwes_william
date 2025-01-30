<html>
   
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Baja - Employees</title>
    <link rel="stylesheet" href="../views/css/bootstrap.min.css">
  </head>
   
  <body>
    <h1>RRHH</h1> 

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Baja Empleado</div>
		<div class="card-body">
	  
	   

	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">
			<B>Empleados: </B><select name="empdata" class="form-control">
			<option value="">-- Seleccionar Empleado --</option>
				<?php
					foreach ($empleados as $empleado) {
						echo "<option value='{$empleado['EMP_NO']}#{$empleado['FIRST_NAME']} {$empleado['LAST_NAME']}'>{$empleado['FIRST_NAME']} {$empleado['LAST_NAME']}</option>";
					}
				?>
			</select>
			<br>
		<div>
			<input type="submit" value="Baja" name="blocked" class="btn btn-warning disabled">
			<input type="button" value="Volver" name="Volver" class="btn btn-warning disabled" onclick="window.location.href='welcomeRRHH_controller.php'">
		</div>
		<br>
		<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") {//☻
				if (isset($_POST["blocked"]) && !empty($_POST["empdata"])) {
					if (!is_null($blocked)) {
						if ($blocked) {
							echo "El empleado, $empno - $empname, ha si dado de baja";
						} else {
							echo "El empleado, $empno - $empname, ya estaba dado de baja";
						}
					} else {
						echo "Ha ocurrido un error, intentelo más tarde";
					}
				} else {
					echo "Tiene que seleccionar el empleado";
				}
			}
		?>
	</form>
	<!-- FIN DEL FORMULARIO -->
	<a href="./logout_controller.php">Cerrar Sesión</a><br><br>
	
  </body>
   
</html>