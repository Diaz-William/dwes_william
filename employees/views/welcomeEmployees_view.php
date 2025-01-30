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
     <title>Bienvenido a Employees</title>
	 <link rel="stylesheet" href="../views/css/bootstrap.min.css">
 </head>
   
 <body>
    <h1>Employees</h1> 

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Menú Empleado - OPERACIONES </div>
		<div class="card-body">

		<?php list($fullname, $empno) = explode("#", $_COOKIE["usuario"]) ?>

		<B>Bienvenido/a:</B> <?php echo $fullname ?> <BR><BR>
		<B>Número de Empleado:</B> <?php echo $empno ?> <BR><BR>
	 
		
       <!--Formulario con botones -->
	
		<input type="button" value="Alquilar Vehículo" onclick="window.location.href='alquilar_controller.php'" class="btn btn-warning disabled">
		<input type="button" value="Consultar Alquileres" onclick="window.location.href='consultar_controller.php'" class="btn btn-warning disabled">
		<input type="button" value="Devolver Vehículo" onclick="window.location.href='devolver_controller.php'" class="btn btn-warning disabled">
		</br></br>
		
		
		
		  <BR><a href="./logout_controller.php">Cerrar Sesión</a>
	</div>  
	  
	  
     
   </body>
   
</html>


