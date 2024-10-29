<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>JUEGO DADOS - PRÁCTICA OBLIGATORIA</title>
        <link href="./bootstrap.min.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="container ">
                <!--Aplicacion-->
                <div class="card border-success mb-3" style="max-width: 30rem;">
                    <div class="card-header">
                        <B>JUEGO DADOS</B>
                    </div>
                    <div class="card-body">
                        <b>Nombre: </b><input type='text' name='jug1' value='' size=25><br><br> 
                        <b>Primer Apelliado: </b><input type='text' name='jug2' value='' size=25><br><br> 
                        <b>Jugador 3: </b><input type='text' name='jug3' value='' size=25><br><br> 
                        <b>Jugador 4: </b><input type='text' name='jug4' value='' size=25><br><br><br> 
                        <b>Numero Dados: </b><input type='text' name='numdados' value='' size=5><br><br>
                        <b>Pulsa para Tirar Dados:</b>
                        <div>
                            <input type="submit" value="Tirar Dados" name="tirar" class="btn btn-warning disabled">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </body>
</html>