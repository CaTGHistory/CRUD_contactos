<?php

include_once("model/User.php");
session_start();

$sErr = "";
$sCve = "";
$sNom = "";
$sPwd = "";
$oUsu = new User();

if (
    isset($_POST["txtCve"]) && !empty($_POST["txtCve"]) &&
    isset($_POST["txtPwd"]) && !empty($_POST["txtPwd"])
) {
    $sCve = $_POST["txtCve"];
    $sPwd = $_POST["txtPwd"];
    $oUsu ->setClave($sCve);
    $oUsu->setPassword($sPwd);
    try {
        if ($oUsu->SrhCvePwd()) {
            $_SESSION["usu"] = $oUsu;
            if ($oUsu -> getType() == User::ADMIN_USER) {
                $_SESSION["tipo"] = "Administrador";
            }elseif ($oUsu ->getType() == User::USER) {
                $_SESSION["tipo"] = "Usuario";
            }else{
                $sErr = "Usuario desconocido";
            }
        }
    } catch (Exception $e) {
        $sErr = "Error al acceder a la base de datos" . $e->getFile() ." ".$e->getLine() . " " .$e->getMessage();
    }
}else {
    $sErr = "Ausencia de datos";
}

if ($sErr == "") {
    header("Location: inicio.php");
}else {
    header("Location: error.php?sError=".$sErr);
}

?>