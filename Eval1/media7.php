<!DOCTYPE html>
  <html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="author" content="William Diaz">
    <title>media7.php</title>
    <style>
      table, th, td {
        border:1px solid black;
      }
    </style>
  </head>
  <body>
    <?php
      // Incluir el archivo de funciones.
      include 'media7func.php';
      // Incluir el archivo de manejo de errores.
      include 'errores.php';
      // Establecer la función "error_function" para el manejo de errores.
      set_error_handler("error_function");

      // Comprobar si se han enviado los datos del formulario por el método POST.
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario y declaración de variables.
        $nombre1 = test_input($_POST["nombre1"]);
        $nombre2 = test_input($_POST["nombre2"]);
        $nombre3 = test_input($_POST["nombre3"]);
        $nombre4 = test_input($_POST["nombre4"]);
        $numcartas = intval(test_input($_POST["numcartas"]));
        $apuesta = floatval(test_input($_POST["apuesta"]));
        $nombres = array();
        $jugadores = array();

        if (empty($nombre1) || empty($nombre2)) {
          // Mostrar un error si no se ha introducido los dos primeros nombres de los jugadores.
          trigger_error("Debe introducir los dos primeros nombres de los jugadores");
        } else if (empty($numcartas) || $numcartas < 2 || $numcartas > 10) {
          // Mostrar un error si la cantidad de cartas no está en el rango permitido (2 - 10) o no se ha introducido un número.
          trigger_error("Debe introducir un número de cartas del 2 al 10");
        } else {
          // Guardar todos nombres introducidos en el array $nombres.
          array_push($nombres, $nombre1, $nombre2, $nombre3, $nombre4);
    
          // Rellenar el array $jugadores con los nombres y sus datos.
          $jugadores = rellenarJugadores($nombres);
          // Repartir las cartas de los jugadores y realizar la suma.
          $jugadores = repartirCartas($jugadores, $numcartas);
    
          // Obtener los ganadores y repartir el premio.
          obtenerGanadores($jugadores, $apuesta);
          // Mostrar los resultados.
          mostrarResultados($jugadores);
          // Mostrar los ganadores y el total de ganadores.
          mostrarGanadores($jugadores);
          // Guardar la apuesta en el archivo apuestas.txt.
          guardarApuestas($jugadores);
        }
      }
    ?>
  </body>
</html>