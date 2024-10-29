<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>JUEGO DADOS - PRÁCTICA OBLIGATORIA</title>
        <link href="./bootstrap.min.css" rel="stylesheet" type="text/css">
        <style>
            p {
                padding-left: 20px;
            }
            form {
                margin-top: 20px;
            }
        </style>
    </head>
    <body>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="container ">
                <!--Aplicacion-->
                <div class="card border-success mb-3" style="max-width: 30rem;">
                    <div class="card-header">
                        <B>REGISTRO JUEGO DADOS</B>
                    </div>
                    <div class="card-body">
                        <b>Nombre:  </b><input type='text' name='nombre' value='' size=25><br><br> 
                        <b>Primer Apellido:  </b><input type='text' name='apellido' value='' size=25><br><br> 
                        <b>Pulsa registrarte:</b>
                        <div>
                            <input type="submit" value="Registrarse" name="registrar" class="btn btn-warning disabled">
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <?php
            // Incluir el archivo "funciones_dados.php".
            include "funciones_dados.php";
            // Incluir el archivo "errores_sistema.php".
            include "errores_sistema.php";
            // Establecer la función "error_function" para el manejo de errores.
            set_error_handler("error_function");

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nomFichero = "jugadores.txt";
                $nombre = test_input($_POST["nombre"]);
                $apellido = test_input($_POST["apellido"]);

                guardarNombresFichero($nomFichero, $nombre, $apellido);

                echo "<p>Te has registrado correctamente: $nombre $apellido</p>";
            }
        ?>
    </body>
</html>