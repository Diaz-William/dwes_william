<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JUEGO DADOS - PRÁCTICA OBLIGATORIA</title>
    <link href="./bootstrap.min.css" rel="stylesheet" type="text/css">
    <style>
      table, th, td {
        border:1px solid black;
      }
      p, table {
        padding-left: 20px;
      }
    </style>
  </head>
  <body>
    <form name='juegodados' method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <div class="container ">
        <!--Aplicacion-->
        <div class="card border-success mb-3" style="max-width: 30rem;">
          <div class="card-body">
            <b>Numero Dados: </b><input type='text' name='numdados' value='' size=5><br><br>
            <b>Pulsa para jugar:</b>
            <div>
              <input type="submit" value="Jugar" name="jugar" class="btn btn-warning disabled">
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

      // Comprobar si se han enviado los datos del formulario por el método POST.
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario y declaración de variables.
        $cantDados = intval(test_input($_POST["numdados"]));
        $nombres = array();
        $jugadores = array();
        $ganadores = array();

        // Guardar todos nombres del archivo en el array $nombres.
        $nombres = obtenerDatos("jugadores.txt");

        if (count($nombres) <= 1) {
          // Mostrar un error si no  hay jugadores en el archivo.
          trigger_error("No hay jugadores en el archivo");
        }else if ($cantDados < 1 || $cantDados > 10) {
          // Mostrar un error si la cantidad de dados no está en el rango permitido (1 - 10).
          trigger_error("Debe introducir un número de dados del 1 al 10");
        } else {
          // Rellenar el array $jugadores con los nombres y sus datos.
          $jugadores = rellenarJugadores($nombres);
          // Realizar las tiradas de todos los dados de los jugadores.
          $jugadores = tirarDados($jugadores, $cantDados);

          // Obtener los ganadores.
          $ganadores = obtenerGanadores($jugadores);
          // Mostrar los resultados de las tiradas y su puntuación.
          mostrarResultados($jugadores);
          // Mostrar los ganadores y el total de ganadores.
          mostrarGanadores($ganadores);
        }
      }
    ?>
  </body>
</html>