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
    <h1>RRHH</h1> 

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Información Nómina</div>
		<div class="card-body">
	  
	   

	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">
			<?php
				echo "Primer Nombre: {$empdata[0]['FIRST_NAME']} <br>";
				echo "Apellido: {$empdata[0]['LAST_NAME']} <br>";
				echo "Nacimiento: {$empdata[0]['BIRTH_DATE']} <br>";
				echo "Género: {$empdata[0]['GENDER']} <br>";
				echo "Contratación: {$empdata[0]['HIRE_DATE']} <br>";
			?>
			<br>
			Salario Bruto: <?php number_format($salary, 2) ?> €
			Descuento Seguridad Social (7.5%): <?php number_format($seguridad_social, 2) ?> €
			Descuento IRPF: <?php number_format($irpf, 2) ?> €
			Salario Neto: <?php number_format($net_salary, 2) ?> €
		<div>
			<input type="submit" value="Consultar" name="consult" class="btn btn-warning disabled">
			<input type="button" value="Volver" name="Volver" class="btn btn-warning disabled" onclick="window.location.href='welcomeRRHH_controller.php'">
		</div>
		<br>
	</form>
	<!-- FIN DEL FORMULARIO -->
	<a href="./logout_controller.php">Cerrar Sesión</a><br><br>
	
  </body>
   
</html>