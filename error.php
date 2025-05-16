<?php
session_start();
$sErr;
if (isset($_REQUEST["sError"]) )
    $sErr = $_GET["sError"];
else
    $sErr = "Otro Error";



if (isset($_SESSION["usu"])) {
    header("Location: mostrarcon.php?x=1&sError='". $sErr ."'");
} else {
    header("Location: index.php?x=1&sError='" . $sErr ."'");    
}
exit();

?>