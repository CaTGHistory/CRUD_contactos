<?php
include_once("model/User.php");
include_once("model/Contactos.php");

session_start();
$j = 0;
$sErr = "";
$sNom = "";
$arrContactos = null;
$oUsu = new User();
$oContact = new Contactos();
if (isset($_SESSION["usu"]) && !empty($_SESSION["usu"])) {
    $oUsu = $_SESSION["usu"];
    $sNom = $oUsu->getName();
    try {
        $arrContactos = $oContact->searchAll($oUsu->getType(), $oUsu->getClave());
    } catch (Exception $e) {
        error_log($e->getFile() . " " . $e->getLine() . " " . $e->getMessage(), 0);
        $sErr = "Error en la base de datos, comunicarse con el aministrador " . $e->getFile() . " " . $e->getLine() . " " . $e->getMessage();
    }
} else {
    $sErr = "Falta establecer el login";
}
if ($sErr == "") {
    include_once("header.html");
    include_once("menu.php");
    if (isset($_REQUEST["x"]) && isset($_REQUEST["sError"])) {
        echo "<script> let x = " . $_REQUEST["x"] . ";
        let sMsg = " . $_REQUEST["sError"] . ";</script>";
    } else { 
        echo "<script> let x = 0;</script>";
    }
} else {
    header("Location: error.php?sError=" . $sErr);
    exit();
}
?>

<main>
    <section id="tablas">
        <h3>Contactos</h3>
        <form method="post" name="FormTabla" action="formcontacto.php">
            <input type="hidden" name="txtClave">
            <input type="hidden" name="txtOpe">
            <table>
                <tr>
                    <td>Nombre</td>
                    <td>Direccion</td>
                    <td>Telefono</td>
                    <td>e-Mail</td>
                    <?php
                    if ($oUsu->getType() == User::ADMIN_USER) {
                        ?>
                        <td>Id de Usuario</td>
                        <?php
                    } ?>
                    <td>Operaciones</td>
                </tr>
                <?php
                if ($arrContactos != null) {
                    foreach ($arrContactos as $oContact) {
                        ?>
                        <tr id="<?php echo 'cont-' . $j ?>">
                            <td><?php echo $oContact->getNombreC(); ?></td>
                            <td><?php echo $oContact->getDireccion(); ?></td>
                            <td><?php echo $oContact->getTelefono(); ?></td>
                            <td><?php echo $oContact->getEmail(); ?></td>
                            <?php
                            if ($oUsu->getType() == User::ADMIN_USER) {
                                ?>
                                <td><?php echo $oContact->getCveUser(); ?></td>
                                <?php
                            }
                            ?>
                            <td class="Btin">
                                <input type="submit" class="Md" value="Modificar" name="submit"
                                    onClick="txtClave.value=<?php echo $oContact->getId(); ?>; txtOpe.value='m';">
                                <input type="submit" class="Br" value="Borrar" name="submit"
                                    onClick="txtClave.value=<?php echo $oContact->getId(); ?>; txtOpe.value='b';">
                            </td>
                        </tr>
                        <?php
                        $j++;
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="2">No hay datos</td>
                    </tr>
                    <?php

                }
                ?>
            </table>
            <input type="submit" id="Cn" name="submit" value="Crear Nuevo"
                onClick="txtClave.value='-1';txtOpe.value='a'">
        </form>
    </section>

    <?php
    include_once("aside.html");
    include_once("footer.html");

    ?>