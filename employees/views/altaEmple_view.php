<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ALta EMpleado - Employees</title>
    <link rel="stylesheet" href="../views/css/bootstrap.min.css">
 </head>
      
<body>
    <h1>Employees</h1>

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Alta Empleado</div>
		<div class="card-body">
            <form id="" name="" action="" method="post" class="card-body">
                <div class="form-group">
                    Nombre <input type="text" name="name" placeholder="name" class="form-control">
                </div>
                <div class="form-group">
                    Apellido <input type="text" name="lastname" placeholder="lastname" class="form-control">
                </div>
                <div class="form-group">
                    Fecha de nacimiento <input type="date" name="birthdate" placeholder="birthdate" class="form-control">
                </div>
                <div class="form-group">
                    Género
                    <input type="radio" id="M" name="gender" value="M">
                    <label for="M">Hombre</label><br>
                    <input type="radio" id="F" name="gender" value="F">
                    <label for="F">Mujer</label><br>
                </div>
                <input type="submit" name="submit" value="Login" class="btn btn-warning disabled">
            </form>
	    </div>
    </div>
    </div>
    </div>

</body>
</html>