<?php
include_once("model/User.php");
session_start();
$sErr = "";
$sNom = "";
$sTipo = "";
$oUsu = new User();

if (isset($_SESSION["usu"])) {
    $oUsu = $_SESSION["usu"];
    $sNom = $oUsu->getName();
    $sTipo = $_SESSION["tipo"];
} else {
    $sErr = "Usuario o contraseña desconocidos";
}

if ($sErr == "") {
    include_once("header.html");
    include_once("menu.php");
} else {
    header("Location: error.php?sError=" . $sErr);
    exit();
}
?>

<Main>
    <section id="inicio">
    <h1>Bienvenido <?php echo $sNom;?></h1>
    <h1>Eres tipo <?php echo $sTipo;?></h1>
</section>
<?php
include_once("aside.html");
include_once("footer.html");
?>