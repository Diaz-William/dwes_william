﻿<html>
   
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
		<div class="card-header">Menú Usuario - CONSULTA ALQUILERES </div>
		<div class="card-body">
	  
	  	
	   

	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">
		<?php list($usuario, $id) = explode("#", $_COOKIE["datos"]) ?>
		<B>Bienvenido/a:</B> <?php echo $usuario ?> <BR><BR>
		<B>Identificador Cliente:</B> <?php echo $id ?> <BR><BR>
		     
			 Fecha Desde: <input type='date' name='fechadesde' value='' size=8 placeholder="fechadesde" class="form-control">
			 Fecha Hasta: <input type='date' name='fechahasta' value='' size=8 placeholder="fechahasta" class="form-control"><br><br>
				
		<div>
			<input type="submit" value="Consultar" name="Volver" class="btn btn-warning disabled">
		
			<input type="button" value="Volver" name="Volver" class="btn btn-warning disabled">
		
		</div>		
	</form>
	<!-- FIN DEL FORMULARIO -->
    <a href="./logout_controller.php">Cerrar Sesión</a>

  </body>
   
</html>
