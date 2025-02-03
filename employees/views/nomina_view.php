<?php
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
    <h1>Employee</h1> 

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Información Nómina</div>
		<div class="card-body">
	  
	   

	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">
			<?php
				echo "<b>Primer Nombre</b>: {$empdata[0]['FIRST_NAME']} <br><br>";
				echo "<b>Apellido</b>: {$empdata[0]['LAST_NAME']} <br><br>";
				echo "<b>Nacimiento</b>: {$empdata[0]['BIRTH_DATE']} <br><br>";
				echo "<b>Género</b>: {$empdata[0]['GENDER']} <br><br>";
				echo "<b>Contratación</b>: {$empdata[0]['HIRE_DATE']} <br><br>";
				echo "<b>Salario Bruto</b>: $salary € <br><br>";
				echo "<b>Descuento Seguridad Social (7.5%)</b>: $seguridad_social € <br><br>";
				echo "<b>Descuento IRPF</b>: $irpf € <br><br>";
				echo "<b>Salario Neto</b>: $net_salary € <br><br>";

				echo "<b>Historial Departamentos</b><br><br>";
				foreach ($depts as $index => $text) {
					echo $text["INFO"]."<br>";
					
				}
				echo "<br>";
				echo "<b>Historial Titulos</b><br><br>";
				foreach ($titles as $index => $text) {
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