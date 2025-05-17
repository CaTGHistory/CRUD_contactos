<?php
include_once("model/Contactos.php");
include_once("model/User.php");
session_start();

$sErr = "";
$sOpe = "";
$sCve = "";
$oContact = new Contactos();
if (isset($_SESSION["usu"]) && !empty($_SESSION["usu"])) {

    if (
        isset($_POST["txtClave"]) &&
        isset($_POST["txtOpe"]) && !empty($_POST["txtOpe"])
    ) {
        $sOpe = $_POST["txtOpe"];
        $sCve = $_POST["txtClave"];
        $oContact->setId($_POST["txtClave"]);
        if ($sOpe != 'b') {
            $oContact->setNombre($_POST["txtNombre"]);
            $oContact->setApep($_POST["txtApePat"]);
            $oContact->setApem($_POST["txtApeMat"]);
            $oContact->setDireccion($_POST["txtDir"]);
            $oContact->setTelefono($_POST["txtTel"]);
            $oContact->setEmail($_POST["txteMl"]);
            if ($_SESSION["usu"]->getType() == User::ADMIN_USER)
                $oContact->setCveUser($_POST["numUser"]);
            else
                $oContact->setCveUser($_SESSION["usu"]->getClave());
        }
        try {
            if ($sOpe == 'a') {
                $nResultado = $oContact->insert();
            } elseif ($sOpe == 'b') {
                $nResultado = $oContact->delete();
            } else {
                $nResultado = $oContact->update();
            }

            if ($nResultado != 1) {
                $sErr = "Error en DB";
            }
        } catch (Exception $e) {
            error_log($e->getFile() . " " . $e->getLine() . " " . $e->getMessage(), 0);
            $sErr = "Error en base de datos, comunicarse con el administrador" . $e->getFile() . " " . $e->getLine() . " " . $e->getMessage();
        }
    }else {
        $sErr = "Faltan Datos pe " . $_POST["txtClave"] . " " . $_POST["txtOpe"] . !empty($_POST["txtClave"]) ." ". !empty($_POST["txtOpe"]) . " .";
    }
}else {
    $sErr = "Falta establecer el login";
}

if ($sErr == "")
    header("Location: mostrarcon.php");
else
    header("Location: error.php?sError=" . $sErr);
exit();
?>