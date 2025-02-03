﻿<?php
    if (!isset($_COOKIE["usuario"])) {
        header("Location: ../index.php");
    }
?>

<html>
   
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Datos Nómina - Employees</title>
    <link rel="stylesheet" href="../views/css/bootstrap.min.css">
  </head>
   
  <body>
  	<?php
		if (comprobarRRHH($empno)) {
			echo "<h1>RRHH</h1>";
		} else {
			echo "<h1>Employee</h1>";
		}
	?>

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Historial Laboral</div>
		<div class="card-body">
	  
	   

	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">
			<?php
				echo "<b>Historial Departamentos</b><br><br>";
				foreach ($deptEmp as $index => $text) {
					echo $text["INFO"]."<br>";
					
				}
				echo "<br>";
				echo "<b>Historial Salario</b><br><br>";
				foreach ($salEmp as $index => $text) {
					echo $text["INFO"]."<br>";
					
				}
			?>
			<br>
		<div>
			<?php
				if (comprobarRRHH($empno)) {
					echo '<input type="button" value="Volver" name="Volver" class="btn btn-warning disabled" onclick="window.location.href=\'welcomeRRHH_controller.php\'">';
				} else {
					echo '<input type="button" value="Volver" name="Volver" class="btn btn-warning disabled" onclick="window.location.href=\'welcomeEmployees_controller.php\'">';
				}
			?>
		</div>
		<br>
	</form>
	<!-- FIN DEL FORMULARIO -->
	<a href="./logout_controller.php">Cerrar Sesión</a><br><br>
	
  </body>
   
</html>