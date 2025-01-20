<?php
    require_once("../db/db.php");
    require_once("../helpers/error_helper.php");
    set_error_handler("error_function");
    require_once("./apiRedsys.php");
    require_once("../models/respuesta_model.php");
    require_once("../models/pendientePago_model.php");

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
    $matricula = $miObj->getParameter("matricula");
    $fecha_devolver = $miObj->getParameter("fecha_devolver");
    $precio = $miObj->getParameter("DS_MERCHANT_AMOUNT");
    $num_pago = $miObj->getOrder();

    // Calcular la firma del proceso.
    $claveModuloAdmin = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7'; 
    $signatureCalculada = $miObj->createMerchantSignatureNotif($claveModuloAdmin, $params); 

    // Validar la firma.
    if ($signatureCalculada === $signatureRecibida && $codigoRespuesta >= 0 && $codigoRespuesta < 100) { 
        echo "El pago se ha realizado correctamente";
        actualizarAlquileres($num_pago, $matricula, $fecha_devolver, $precio);
    } else { 
        echo "Pendiente de pago $precio €";
        pendientePago($precio);
    }

    require_once("../views/respuesta_view.php");
?>