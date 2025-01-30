<html>
   
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Datos Departamentos - Employees</title>
    <link rel="stylesheet" href="../views/css/bootstrap.min.css">
  </head>
   
  <body>
    <h1>RRHH</h1> 

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Información Departamento</div>
		<div class="card-body">
	  
	   

	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">
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
			<input type="submit" value="Consultar" name="consult" class="btn btn-warning disabled">
			<input type="button" value="Volver" name="Volver" class="btn btn-warning disabled" onclick="window.location.href='welcomeRRHH_controller.php'">
		</div>
		<br>
		<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") {//☻
				if (isset($_POST["consult"]) && !empty($_POST["deptdata"])) {
					if (!is_null($info)) {
						echo "$deptno - $deptname";
						echo "<br><br>";
						echo "Encargado: {$info[0]['MANAGER']} - {$info[0]['FULLNAMEMANAGER']}";
						echo "<br><br>";
						echo "<ul>";
						foreach ($info as $index => $row) {
							if ($index != 0) {
								echo "<li>{$row['EMP_NO']} - {$row['FULLNAME']}</li>";
							}
						}
						echo "</ul>";
					} else {
						echo "Ha ocurrido un error, intentelo más tarde";
					}
				} else {
					echo "Tiene que seleccionar el departamento";
				}
			}
		?>
	</form>
	<!-- FIN DEL FORMULARIO -->
	<a href="./logout_controller.php">Cerrar Sesión</a><br><br>
	
  </body>
   
</html>