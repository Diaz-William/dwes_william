<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>bolsa3.php</title>
    </head>
    <body>
    <h1>Ibex 35</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label id="valores">Valores</label>
        <select id="valores">
            <option value="acciona">ACCIONA</option>
            <option value="acerinox">ACERINOX</option>
            <option value="acs">ACS</option>
            <option value="aena">AENA</option>
            <option value="amadeus_it_group">AMADEUS IT GROUP</option>
            <option value="arcelormittal">ARCELORMITTAL</option>
            <option value="banco_sabadell">BANCO SABADELL</option>
            <option value="bankia">BANKIA</option>
            <option value="bankinter">BANKINTER</option>
            <option value="bbva">BBVA</option>
            <option value="caixabank">CAIXABANK</option>
            <option value="cellnex_telecom">CELLNEX TELECOM</option>
            <option value="cie_automotive">CIE. AUTOMOTIVE</option>
            <option value="colonial">COLONIAL</option>
            <option value="dia">DIA</option>
            <option value="enagas">ENAGAS</option>
            <option value="endesa">ENDESA</option>
            <option value="ferrovial">FERROVIAL</option>
            <option value="grifols">GRIFOLS</option>
            <option value="iag">IAG</option>
            <option value="iberdrola">IBERDROLA</option>
            <option value="inditex">INDITEX</option>
            <option value="indra">INDRA</option>
            <option value="mapfre">MAPFRE</option>
            <option value="mediaset">MEDIASET</option>
            <option value="melia_hotels">MELIA HOTELS</option>
            <option value="merlin_prop">MERLIN PROP.</option>
            <option value="naturgy">NATURGY</option>
            <option value="red_electrica">RED ELECTRICA</option>
            <option value="repsol">REPSOL</option>
            <option value="santander">SANTANDER</option>
            <option value="siemens_gamesa">SIEMENS GAMESA</option>
            <option value="tecnicas_reunidas">TECNICAS REUNIDAS</option>
            <option value="telefonica">TELEFONICA</option>
            <option value="viscofan">VISCOFAN</option>
        </select>
        <br><br>
        <input type="submit" value="Visualizar">
        <input type="reset" value="Borrar">
    </form>
    <?php
        include 'funciones_bolsa.php';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $datos = obtenerDatos();
        }
    ?>
    </body>
</html>