<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page - PORTAL RESERVAS</title>
    <link rel="stylesheet" href="views/css/bootstrap.min.css">
 </head>
      
<body>
    

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Acceso Reserva Vuelos</div>
		<div class="card-body">
		
		<form id="" name="" action="" method="post" class="card-body">
		
		<div class="form-group">
			Usuario <input type="text" name="usuario" placeholder="usuario" class="form-control">
        </div>
		<div class="form-group">
			Password <input type="password" name="password" placeholder="password" class="form-control">
        </div>				
        
		<input type="submit" name="submit" value="Login" class="btn btn-warning disabled">

        <div class="mt-3">
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if ($correcto === false) {
                        echo "<p class='text-center text-danger mt-3'>El usario o la contraseña son incorrectos.</p>";
                    } else if (is_null($correcto)) {
                        echo "<p class='text-center text-danger mt-3'>Ha ocurrido un error. Inténtelo más tarde.</p>";
                    }
                }
            ?>
        </div>

        </form>
		
	    </div>
    </div>
    </div>
    </div>

</body>
</html>