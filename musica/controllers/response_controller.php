<?php
    require_once("../helpers/error_helper.php");
    set_error_handler("error_function");

    require_once("./apiRedsys.php");
    $miObj = new RedsysAPI; 

    $version = $_REQUEST["Ds_SignatureVersion"]; 
    $params = $_REQUEST["Ds_MerchantParameters"]; 
    $signatureRecibida = $_REQUEST["Ds_Signature"];

    $decodec = json_decode(urldecode($params), true);
    var_dump($decodec);

    $codigoRespuesta = $miObj->getParameter("Ds_Response");

    $claveModuloAdmin = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7'; 
    $signatureCalculada = $miObj->createMerchantSignatureNotif($claveModuloAdmin, $params);

    // Verifica si los valores realmente están definidos
    $invoiceid = isset($decodec["Ds_Order"]) ? $decodec["Ds_Order"] : null;
    $invoicedate = isset($decodec["Ds_Date"]) ? date("Y-m-d", strtotime(str_replace("/", "-", $decodec["Ds_Date"]))) : null;
    $amount = isset($decodec["Ds_Amount"]) ? $decodec["Ds_Amount"] : null;
    $cardnumber = isset($decodec["Ds_Card_Number"]) ? $decodec["Ds_Card_Number"] : null;
    $country = isset($decodec["Ds_Card_Country"]) ? $decodec["Ds_Card_Country"] : null;

    // Imprimir los valores para asegurarnos de que no son NULL
    var_dump($invoiceid, $invoicedate, $amount, $cardnumber, $country);

    require_once("../db/db.php");
    require_once("../models/payment_model.php");
    if ($signatureCalculada === $signatureRecibida && $codigoRespuesta >= 0 && $codigoRespuesta < 100) {
        //pay($invoiceid, $invoicedate, $amount, $cardnumber, 0);
    } else {
        //pay($invoiceid, $invoicedate, $amount, $cardnumber, 1);
    }

    require_once("../views/response_view.php");
?>