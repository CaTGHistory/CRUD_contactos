<?php
include_once("model/Contactos.php");
include_once("model/User.php");
session_start();

$sErr = "";
$sOpe = "";
$sCve = "";
$sNomButton = "Borrar";
$bCampoEditable = false;
$bLlaveEditable = false;

$oContact = new Contactos();

if (isset($_SESSION["usu"]) && !empty($_SESSION["usu"])) {
    if (
        isset($_POST["txtClave"]) && !empty($_POST["txtClave"]) &&
        isset($_POST["txtOpe"]) && !empty($_POST["txtOpe"])
    ) {
        $sOpe = $_POST["txtOpe"];
        $sCve = $_POST["txtClave"];
        if ($sOpe != 'a') {
            $oContact->setId($sCve);
            try {
                if (!$oContact->search()) {
                    $sErr = "El contacto no existe";
                }
            } catch (Exception $e) {
                error_log($e->getFile() . " " . $e->getLine() . " " . $e->getMessage(), 0);
                $sErr = "Error en base de datos, comunicarse con el administrador" . $e->getFile() . " " . $e->getLine() . " " . $e->getMessage();
            }
        }
        if ($sOpe == 'a') {
            $bCampoEditable = true;
            $bLlaveEditable = true;
            $sNomButton = "Agregar";
        } else if ($sOpe == 'm') {
            $bCampoEditable = true;
            $sNomButton = "Modificar";
        }
    } else {
        $sErr = "Faltan Datos";
    }
} else {
    $sErr = "Falta establecer el login";
}

if ($sErr == "") {
    include_once("header.html");
    include_once("menu.php");
} else {
    header("Location: error.php?sError=" . $sErr);
    exit();
}
?>
<main>
    <section>
        <form action="resCons.php" name="FormEdit" method="post" id="frmin">
            <input type="hidden"  id="inOp" name="txtOpe" value="<?php echo $sOpe; ?>"/>
            <input type="hidden" id="inCv" name="txtClave" value="<?php echo $oContact->getId(); ?>"/>


            <label for="inNm">Nombre</label><input type="text" name="txtNombre" id="inNm" <?php echo ($bCampoEditable == true ? '' : ' disabled '); ?>
                value="<?php echo $oContact->getNombre(); ?>" />
                <label for="inNm">Apellido Paterno</label><input type="text" name="txtApePat" id="inAp" <?php echo ($bCampoEditable == true ? '' : ' disabled '); ?>
                value="<?php echo $oContact->getApep(); ?>" />
                <label for="inMa">Apellido Materno</label><input type="text" name="txtApeMat" id="inMa" <?php echo ($bCampoEditable == true ? '' : ' disabled '); ?>
                value="<?php echo $oContact->getApem(); ?>" />
                <label for="inDr">Direccion</label><input type="text" name="txtDir" id="inDr" <?php echo ($bCampoEditable == true ? '' : ' disabled '); ?>
                value="<?php echo $oContact->getDireccion(); ?>" />
                <label for="inTf">Telefono</label><input type="text" name="txtTel" id="inRf" <?php echo ($bCampoEditable == true ? '' : ' disabled '); ?>
                value="<?php echo $oContact->getTelefono(); ?>" />
                <label for="inEm">E-Mail</label><input type="text" name="txteMl" id="inEm" <?php echo ($bCampoEditable == true ? '' : ' disabled '); ?>
                value="<?php echo $oContact->getEmail(); ?>" />
                <label for="inUs" <?php echo ($_SESSION["usu"]->getType() == User::USER ? ' hidden ' : '');?>>User</label><input type="number" name="numUser" id="inUs" <?php echo ($bCampoEditable == true ? '' : ' disabled '); echo ($_SESSION["usu"]->getType() == User::USER ? ' hidden ': ''); ?>
                value="<?php echo $oContact->getCveUser(); ?>" />
            <br>
            <div>
                <input id="FrmB1" type="submit" value="<?php echo $sNomButton; ?>"
                    onClick="return evalua(txtNombre, txtApePat, txtDir, numUser);">
                <input id="FrmB2" type="submit" name="Submit" value="Cancelar" onClick="FormEdit.action='mostrarcon.php';">
            </div>
        </form>
    </section>

    <?php
    include_once("aside.html");
    include_once("footer.html");
    ?>