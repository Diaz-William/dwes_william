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
     <title>Bienvenido a RRHH</title>
	 <link rel="stylesheet" href="../views/css/bootstrap.min.css">
 </head>
   
 <body>
    <h1>RRHH</h1> 

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Menú RRHH - OPERACIONES </div>
		<div class="card-body">

		<?php list($fullname, $empno) = explode("#", $_COOKIE["usuario"]) ?>

		<B>Bienvenido/a:</B> <?php echo $fullname ?> <BR><BR>
		<B>Número de Empleado:</B> <?php echo $empno ?> <BR><BR>
	 
		
       <!--Formulario con botones -->
	
		<input type="button" value="Alta Empleado" onclick="window.location.href='altaEmple_controller.php'" class="btn btn-warning disabled">
		<input type="button" value="Alta Masiva Empleados" onclick="window.location.href='altaMasiva_controller.php'" class="btn btn-warning disabled">
		<input type="button" value="Modificar Salario" onclick="window.location.href='cambiarSalario_controller.php'" class="btn btn-warning disabled">
		<br><br>
		<input type="button" value="Vida Laboral" onclick="window.location.href='vidaLaboral_controller.php'" class="btn btn-warning disabled">
		<input type="button" value="Info Departamentos" onclick="window.location.href='infoDept_controller.php'" class="btn btn-warning disabled">
		<input type="button" value="Cambio Departamento" onclick="window.location.href='cambiarDeptEmp_controller.php'" class="btn btn-warning disabled">
		<br><br>
		<input type="button" value="Nuevo Jefe Departamento" onclick="window.location.href='cambiarDeptMan_controller.php'" class="btn btn-warning disabled">
		<input type="button" value="Baja Empleado" onclick="window.location.href='bajaEmp_controller.php'" class="btn btn-warning disabled">
		<hr>
		<input type="button" value="Mi Nómina" onclick="window.location.href='nomina_controller.php'" class="btn btn-warning disabled">
		<input type="button" value="Historial Laboral" onclick="window.location.href='histLab_controller.php'" class="btn btn-warning disabled">
		<br><br>
		
		  <BR><a href="./logout_controller.php">Cerrar Sesión</a>
	</div>  
	  
	  
     
   </body>
   
</html>


