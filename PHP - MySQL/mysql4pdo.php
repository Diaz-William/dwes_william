<?php
/*SELECTs - mysql PDO*/

$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "empleadosmn";
$dpto = "'D001'";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT cod_dpto, nombre FROM dpto WHERE cod_dpto = $dpto");
    $stmt->execute();

    // set the resulting array to associative
     $stmt->setFetchMode(PDO::FETCH_ASSOC);
	 $resultado=$stmt->fetchAll();
	 foreach($resultado as $row) {
        echo "Codigo dpto: " . $row["cod_dpto"]. " - Nombre: " . $row["nombre"]. "<br>";
     }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

?>
