<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ALta EMpleado - Employees</title>
    <link rel="stylesheet" href="../views/css/bootstrap.min.css">
 </head>
      
<body>
    <h1>RRHH</h1>

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Alta Empleado</div>
		<div class="card-body">
            <form id="" name="" action="" method="post" class="card-body">
                <div class="form-group">
                    Nombre <input type="text" name="firstname" placeholder="Jhon" class="form-control">
                </div>
                <div class="form-group">
                    Apellido <input type="text" name="lastname" placeholder="Doe" class="form-control">
                </div>
                <div class="form-group">
                    Fecha de nacimiento <input type="date" name="birthdate" class="form-control">
                </div>
                <div class="form-group">
                    Género<br>
                    <input type="radio" id="M" name="gender" value="M">
                    <label for="M">Hombre</label><br>
                    <input type="radio" id="F" name="gender" value="F">
                    <label for="F">Mujer</label><br>
                </div>

                <label for="deptno">Departamento</label>
                <select name="deptno" class="form-control">
                    <option value="">-- Seleccionar Departamento --</option>
                    <?php
                        foreach ($depts as $row) {
                            echo "<option value='{$row['DEPT_NO']}'>{$row['DEPT_NAME']}</option>";
                        }
                    ?>
			    </select>
                        <br>
                <div class="form-group">
                    Salario Anual <input type="number" name="salary" class="form-control">
                </div>
                <div class="form-group">
                    Cargo <input type="text" name="title" class="form-control">
                </div>
                <input type="submit" name="add" value="Añadir" class="btn btn-warning disabled">
                <input type="submit" name="hire" value="Alta" class="btn btn-warning disabled">
                <input type="button" value="Volver" name="Volver" class="btn btn-warning disabled" onclick="window.location.href='welcomeRRHH_controller.php'"><br><br>
                <?php
                    if (isset($_COOKIE["basketEmp"])) {
                        echo "Hay " . count(unserialize($_COOKIE["basketEmp"])) . " empleados en la cesta";
                    }
                ?>
                <br><br><a href="./logout_controller.php">Cerrar Sesión</a>
            </form>
	    </div>
    </div>
    </div>
    </div>

</body>
</html>