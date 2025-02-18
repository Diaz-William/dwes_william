<?php
    require_once("../helpers/error_helper.php");
    set_error_handler("error_function");

    require_once("./apiRedsys.php");
    $miObj = new RedsysAPI; 

    $version = $_REQUEST["Ds_SignatureVersion"]; 
    $params = $_REQUEST["Ds_MerchantParameters"]; 
    $signatureRecibida = $_REQUEST["Ds_Signature"];

    $decodec = $miObj->decodeMerchantParameters($params);
    $decodec = json_decode($decodec, true);

    $codigoRespuesta = isset($decodec["Ds_Response"]) ? $decodec["Ds_Response"] : null;

    $claveModuloAdmin = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7'; 
    $signatureCalculada = $miObj->createMerchantSignatureNotif($claveModuloAdmin, $params);

    $invoiceid = isset($decodec["Ds_Order"]) ? intval($decodec["Ds_Order"]) : null;
    $amount = isset($decodec["Ds_Amount"]) ? $decodec["Ds_Amount"] : null;
    $cardcountry = isset($decodec["Ds_Card_Country"]) ? $decodec["Ds_Card_Country"] : null;

    require_once("../db/db.php");
    require_once("../models/payment_model.php");
    if ($signatureCalculada === $signatureRecibida && $codigoRespuesta >= 0 && $codigoRespuesta < 100) {
        pay($invoiceid, $amount, $cardcountry, 0);
    } else {
        pay($invoiceid, $amount, $cardcountry, 1);
    }

    require_once("../helpers/emptyBasket_helper.php");
    vaciarbasketTracks();

    require_once("../views/response_view.php");
?>