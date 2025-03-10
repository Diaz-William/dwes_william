<HTML>

<HEAD> 
 <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>JUEGO DADOS - PRÁCTICA OBLIGATORIA</title>
    <link rel="stylesheet" href="./bootstrap.min.css">
    <style>
      table, th, td {
        border:1px solid black;
      }
    </style>
</HEAD>

<BODY>

<form name='juegodados' method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header"><B>JUEGO DADOS</B> </div>
		<div class="card-body">



 
<B>Jugador 1: </B><input type='text' name='jug1' value='' size=25><br><br> 
<B>Jugador 2: </B><input type='text' name='jug2' value='' size=25><br><br> 
<B>Jugador 3: </B><input type='text' name='jug3' value='' size=25><br><br> 
<B>Jugador 4: </B><input type='text' name='jug4' value='' size=25><br><br><br> 
 
<B>Numero Dados: <input type='text' name='numdados' value='' size=5><br><br>


<B>Pulsa para Tirar Dados: 

<div>

	<input type="submit" value="Tirar Dados" name="tirar" class="btn btn-warning disabled">
		
			
		
</div>	

</FORM>

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
    $nomJ1 = test_input($_POST["jug1"]);
    $nomJ2 = test_input($_POST["jug2"]);
    $nomJ3 = test_input($_POST["jug3"]);
    $nomJ4 = test_input($_POST["jug4"]);
    $cantDados = intval(test_input($_POST["numdados"]));
    $nombres = array();
    $jugadores = array();
    $ganadores = array();

    if (empty($nomJ1) || empty($nomJ2)) {
      // Mostrar un error si no se ha introducido los dos primeros nombres de los jugadores.
      trigger_error("Debe introducir los dos primeros nombres de los jugadores");
    } else if ($cantDados < 1 || $cantDados > 10) {
      // Mostrar un error si la cantidad de dados no está en el rango permitido (1 - 10).
      trigger_error("Debe introducir un número de dados del 1 al 10");
    } else {
      // Guardar todos nombres introducidos en el array $nombres.
      array_push($nombres, $nomJ1, $nomJ2, $nomJ3, $nomJ4);

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

</BODY>

</HTML>