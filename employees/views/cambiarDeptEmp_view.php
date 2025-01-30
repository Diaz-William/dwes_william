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
				
			<B>Empleados: </B><select name="empdata" class="form-control">
			<option value="">-- Seleccionar Empleado --</option>
				<?php
					foreach ($empleados as $empleado) {
						echo "<option value='{$empleado['EMP_NO']}#{$empleado['FIRST_NAME']} {$empleado['LAST_NAME']}>{$empleado['EMP_NO']} - {$empleado['FIRST_NAME']} {$empleado['LAST_NAME']}</option>";
					}
				?>
			</select>
			<br><br><br><br><br><br>
			<B>Departamentos: </B><select name="deptdata" class="form-control">
			<option value="">-- Seleccionar Departamento --</option>
				<?php
					foreach ($depts as $dept) {
						echo "<option value='{$dept['DEPT_NO']}#{$dept['DEPT_NAME']}'>{$dept['DEPT_NAME']}</option>";
					}
				?>
			</select>
			<br>
		<div>
			<input type="submit" value="Cambiar" name="change" class="btn btn-warning disabled">
			<input type="button" value="Volver" name="Volver" class="btn btn-warning disabled" onclick="window.location.href='welcomeRRHH_controller.php'">
		</div>
		<br>
		<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				if (isset($_POST["change"]) && !empty($_POST["empdata"]) && !empty($_POST["deptdata"])) {
					if (!is_null($change)) {
						echo "Se ha cambiado al empleado, $empno - $empname, al departamento de $deptname";
					} else {
						echo "Ha ocurrido un error, intentelo más tarde";
					}
				} else {
					echo "Tiene que seleccionar el empleado y el departamento";
				}
			}
		?>
	</form>
	<!-- FIN DEL FORMULARIO -->
	<a href="./logout_controller.php">Cerrar Sesión</a><br><br>
	
  </body>
   
</html>