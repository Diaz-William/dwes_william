<html>
   
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Cambiar Salario - Employees</title>
    <link rel="stylesheet" href="../views/css/bootstrap.min.css">
  </head>
   
  <body>
    <h1>RRHH</h1> 

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Cambiar Salario Empleado</div>
		<div class="card-body">
	  
	   

	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">
			<B>Empleados: </B><select name="empno" class="form-control">
			<option value="">-- Seleccionar Empleado --</option>
				<?php
					foreach ($empleados as $empleado) {
						echo "<option value='{$empleado['EMP_NO']}'>{$empleado['EMP_NO']} - {$empleado['FIRST_NAME']} {$empleado['LAST_NAME']}</option>";
					}
				?>
			</select>
			<div class="form-group">
				<b>Porcentaje</b> <input type="number" name="percentage" placeholder="50" class="form-control">
        	</div>
			<div class="form-group">
                    Acción<br>
                    <input type="radio" id="+" name="action" value="+">
                    <label for="+">+</label><br>
                    <input type="radio" id="-" name="action" value="-">
                    <label for="-">-</label><br>
                </div>
		<div>
			<input type="submit" value="Cambiar Salario" name="change" class="btn btn-warning disabled">
			<input type="button" value="Volver" name="Volver" class="btn btn-warning disabled" onclick="window.location.href='welcomeRRHH_controller.php'">
		</div>
		<br>
		<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (isset($_POST["change"]) && !empty($_POST["empno"]) && !empty($_POST["percentage"]) && !empty($_POST["action"])) {
				if ($cambio === 0) {
					echo "No se puede actualizar el salario del empleado con el número $empno porque es 0";
				} else if ($cambio >= 0) {
					echo "Se ha actualizado el salario del empleado con el número $empno de $currentsalary a $cambio";
				} else {
					echo "Ha ocurrido un error, intentelo más tarde";
				}
			} else {
				echo "Tiene que seleccionar y rellenar todos los datos";
			}
		}
		?>
	</form>
	<!-- FIN DEL FORMULARIO -->
	<a href="./logout_controller.php">Cerrar Sesión</a><br><br>
	
  </body>
   
</html>