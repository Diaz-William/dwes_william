<?php
    require_once("../helpers/error_helper.php");
    set_error_handler("error_function");

    require_once("../models/getInvoice_model.php");
    $invoices = getInvoice();

    require_once("../views/histInvoice_view.php");
?>