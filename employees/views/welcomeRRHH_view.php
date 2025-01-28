<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Bienvenido a RRHH</title>
	 <link rel="stylesheet" href="../views/css/bootstrap.min.css">
 </head>
   
 <body>
    <h1>RRHH</h1> 

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Menú Usuario - OPERACIONES </div>
		<div class="card-body">

		<?php /*list($usuario, $id) = explode("#", $_COOKIE["datos"])*/ ?>

		<B>Bienvenido/a:</B> <?php /*echo $usuario*/ ?> <BR><BR>
		<B>Identificador Cliente:</B> <?php /*echo $id*/ ?> <BR><BR>
	 
		
       <!--Formulario con botones -->
	
		<input type="button" value="Alta Empleado" onclick="window.location.href='altaEmple_controller.php'" class="btn btn-warning disabled">
		<input type="button" value="Alta Masiva Empleados" onclick="window.location.href='altaMasiva_controller.php'" class="btn btn-warning disabled">
		<input type="button" value="Modificar Salario" onclick="window.location.href='cambiarSalario_controller.php'" class="btn btn-warning disabled">
		<input type="button" value="Vida Laboral" onclick="window.location.href='alquilar_controller.php'" class="btn btn-warning disabled">
		<input type="button" value="Info Departamentos" onclick="window.location.href='consultar_controller.php'" class="btn btn-warning disabled">
		<input type="button" value="Cambio Departamento" onclick="window.location.href='devolver_controller.php'" class="btn btn-warning disabled">
		<input type="button" value="Nuevo Jefe Departamento" onclick="window.location.href='alquilar_controller.php'" class="btn btn-warning disabled">
		<input type="button" value="Baja Empleado" onclick="window.location.href='consultar_controller.php'" class="btn btn-warning disabled">
		</br></br>
		
		
		
		  <BR><a href="./logout_controller.php">Cerrar Sesión</a>
	</div>  
	  
	  
     
   </body>
   
</html>


