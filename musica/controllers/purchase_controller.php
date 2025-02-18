<?php
    require_once("../helpers/error_helper.php");
    set_error_handler("error_function");

    if (isset($_COOKIE["basketTracks"])) {
        require_once("./apiRedsys.php");
        $miObj = new RedsysAPI;

        $fuc = "263100000";
        $terminal = "22";
        $moneda = "978";
        $trans = "0";
        $url = "";
        $urlOKKO = "http://192.168.206.221/dwes_william/musica/controllers/response_controller.php";
        //$urlOKKO = "http://192.168.0.111/dwes_william/musica/controllers/response_controller.php";
        require_once("../db/db.php");
        require_once("../models/getInvoiceId_model.php");
        $invoiceid = getInvoiceId();
        require_once("../models/getAmount_model.php");
        $amount = getAmount();
        
        $miObj->setParameter("DS_MERCHANT_AMOUNT",$amount);
        $miObj->setParameter("DS_MERCHANT_ORDER",str_pad($invoiceid, 12, "0", STR_PAD_LEFT));
        $miObj->setParameter("DS_MERCHANT_MERCHANTCODE",$fuc);
        $miObj->setParameter("DS_MERCHANT_CURRENCY",$moneda);
        $miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE",$trans);
        $miObj->setParameter("DS_MERCHANT_TERMINAL",$terminal);
        $miObj->setParameter("DS_MERCHANT_MERCHANTURL",$url);
        $miObj->setParameter("DS_MERCHANT_URLOK",$urlOKKO);
        $miObj->setParameter("DS_MERCHANT_URLKO",$urlOKKO);

        $version="HMAC_SHA256_V1";
        $kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';

        $request = "";
        $params = $miObj->createMerchantParameters();
        $signature = $miObj->createMerchantSignature($kc);
    } else {
        echo "La cesta esta vacía";
    }

    require_once("../views/purchase_view.php");
?>