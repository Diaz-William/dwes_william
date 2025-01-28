<html>
   
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Datos Empleado - Employees</title>
    <link rel="stylesheet" href="../views/css/bootstrap.min.css">
  </head>
   
  <body>
    <h1>RRHH</h1> 

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Menú Usuario - DEVOLUCIÓN VEHÍCULO </div>
		<div class="card-body">
	  
	   

	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">
		<?php /*list($usuario, $id) = explode("#", $_COOKIE["datos"])*/ ?>
		<B>Bienvenido/a:</B> <?php /*echo $usuario*/ ?> <BR><BR>
		<B>Identificador Cliente:</B> <?php /*echo $id*/ ?> <BR><BR>
				
			<B>Empleados: </B><select name="emp" class="form-control">
			<option value="">-- Seleccionar Empleado --</option>
				<?php
					foreach ($empleados as $empleado) {
						echo "<option value='{$empleado['EMP_NO']}#{$empleado['FIRST_NAME']} {$empleado['LAST_NAME']}'>{$empleado['EMP_NO']} | {$empleado['FIRST_NAME']} | {$empleado['LAST_NAME']}</option>";
					}
				?>
			</select>
			<br>
			<B>Tipo de información: </B><select name="info" class="form-control">
			<option value="">-- Seleccionar Información --</option>
			<option value="dataEmp">Datos personales</option>
			<option value="depts">Departamentos</option>
			<option value="salaries">Salarios</option>
			<option value="titles">Cargos</option>
			</select>
			<br>
		<div>
			<input type="submit" value="Consultar" name="consult" class="btn btn-warning disabled">
			<input type="button" value="Volver" name="Volver" class="btn btn-warning disabled" onclick="window.location.href='welcomeRRHH_controller.php'">
		</div>
		<br>
		<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				if (isset($_POST["consult"]) && !empty($_POST["emp"]) && !empty($_POST["info"])) {
					if (!is_null($info)) {
						echo $fullname;
						echo "<br>";
						var_dump($info);
					} else {
						echo "Ha ocurrido un error, intentelo más tarde";
					}
				} else {
					echo "Tiene que seleccionar el empleado y el tipo de información";
				}
			}
		?>
	</form>
	<!-- FIN DEL FORMULARIO -->
	<a href="./logout_controller.php">Cerrar Sesión</a><br><br>
	
  </body>
   
</html>