<?php
    // Incluir el archivo de funciones.
	include "funciones_pe_altaped.php";
    // Se incluye la librería de Redsys.
    include 'apiRedsys.php';
    // Incluir el archivo de manejo de errores.
    include "errores.php";
    // Establecer la función "error_function" para el manejo de errores.
    set_error_handler("error_function");

    // Definir un objeto de la clase principal de la librería.
    $miObj = new RedsysAPI; 

    // Capturar los parámetros de la notificación on-line.
    $version = $_REQUEST["Ds_SignatureVersion"]; 
    $params = $_REQUEST["Ds_MerchantParameters"]; 
    $signatureRecibida = $_REQUEST["Ds_Signature"];

    // Decodificar el parámetro Ds_MerchantParameters.
    $decodec = $miObj->decodeMerchantParameters($params); 

    // Obtener el valor de cualquier parámetro.
    $codigoRespuesta = $miObj->getParameter("Ds_Response"); 

    // Calcular la firma del proceso.
    $claveModuloAdmin = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7'; 
    $signatureCalculada = $miObj->createMerchantSignatureNotif($claveModuloAdmin, $params); 

    // Validar la firma.
    if ($signatureCalculada === $signatureRecibida && $codigoRespuesta >= 0 && $codigoRespuesta < 100) { 
        echo "FIRMA OK. Realizar tareas en el servidor";
        comprarProductoSesionCookies($_COOKIE["numPago"], true);
    } else { 
        echo "FIRMA KO. Error, firma inválida";
        comprarProductoSesionCookies($_COOKIE["numPago"], false);
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respuesta</title>
</head>
<body>
    <h2><a href="./pe_inicio.php">Inicio</a></h2>
</body>
</html>