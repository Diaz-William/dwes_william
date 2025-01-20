<?php
    require_once("../db/db.php");
    require_once("../helpers/error_helper.php");
    set_error_handler("error_function");
    require_once("../models/devolver_model.php");
    require_once("../models/obtenerPrecio_model.php");
    require_once("../models/obtenerNumPago_model.php");
    require_once("./apiRedsys.php");

    date_default_timezone_set('Europe/Madrid');
    $alquilados = obtenerVehiculosAlquilados();
    $pagar = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST["vehiculos"])) {
            $fecha_devolver = date("Y-m-d H:i:s");
            $matricula = $_POST["vehiculos"];

            $miObj = new RedsysAPI;

            $fuc="263100000";
            $terminal="7";
            $moneda="978";
            $trans="0";
            $url="";
            $urlOKKO="http://192.168.206.221/dwes_william/MVC/";
            $orderNumber=sigNumPago();
            $amount=obtenerPrecio($fecha_devolver, $matricula) * 100;	
            var_dump($amount);
            
            $miObj->setParameter("DS_MERCHANT_AMOUNT",$amount);
            $miObj->setParameter("DS_MERCHANT_ORDER",$orderNumber);
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

            $pagar = true;
        } else {
            echo "Tiene que seleccionar un vehículo a devolver";
        }
    }

    require_once("../views/devolver_view.php");
?>