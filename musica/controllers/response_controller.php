<?php
    require_once("../helpers/error_helper.php");
    set_error_handler("error_function");

    require_once("./apiRedsys.php");
    $miObj = new RedsysAPI; 

    $version = $_REQUEST["Ds_SignatureVersion"]; 
    $params = $_REQUEST["Ds_MerchantParameters"]; 
    $signatureRecibida = $_REQUEST["Ds_Signature"];

    $decodec = $miObj->decodeMerchantParameters($params);
    var_dump($decodec);

    $codigoRespuesta = $miObj->getParameter("Ds_Response");

    $claveModuloAdmin = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7'; 
    $signatureCalculada = $miObj->createMerchantSignatureNotif($claveModuloAdmin, $params);

    $invoiceid = $miObj->getOrder();
    $invoicedate = date("Y-m-d", strtotime($miObj->getParameter("DS_DATE")));
    $amount = $miObj->getParameter("DS_AMOUNT");
    $cardnumber = $miObj->getParameter("DS_CARD_NUMBER");
    $country = $miObj->getParameter("DS_CARD_COUNTRY");
    var_dump($country);

    require_once("../db/db.php");
    require_once("../models/payment_model.php");
    if ($signatureCalculada === $signatureRecibida && $codigoRespuesta >= 0 && $codigoRespuesta < 100) {
        //pay($invoiceid, $invoicedate, $amount, $cardnumber, 0);
    } else {
        //pay($invoiceid, $invoicedate, $amount, $cardnumber, 1);
    }

    require_once("../views/response_view.php");
?>