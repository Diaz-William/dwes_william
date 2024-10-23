<HTML>

<HEAD> 
 <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>JUEGO DADOS - PRÁCTICA OBLIGATORIA</title>
    <link rel="stylesheet" href="./bootstrap.min.css">
  </head>
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
  include "funciones_dados.php";
  include "errores_sistema.php";
  set_error_handler("error_function");

  $nomJ1 = $nomJ2 = $nomJ3 = $nomJ4 = "";
  $nombres = array();
  $jugadores = array();
  $cantDados = 0;


  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["jug1"] == "" && $_POST["jug2"] == "") {
      trigger_error("Debe introducir mínimo dos nombres de los jugadores");
    }else if (intval($_POST["numdados"]) < 1 || intval($_POST["numdados"]) > 10) {
      trigger_error("Debe introducir un números de dados del 1 al 10");
    }else {
      $nomJ1 = test_input($_POST["jug1"]);
      $nomJ2 = test_input($_POST["jug2"]);
      $nomJ3 = test_input($_POST["jug3"]);
      $nomJ4 = test_input($_POST["jug4"]);
      $cantDados = intval(test_input($_POST["numdados"]));
      array_push($nombres,$nomJ1,$nomJ2,$nomJ3,$nomJ4);
      $jugadores = rellenarJugadores($nombres, $cantDados);
      //var_dump($jugadores);
      $jugadores = tirarDados($jugadores);
    }
  }
?>

</BODY>

</HTML>