<?php
include_once("header.html");
include_once("menu.php");
if (isset($_REQUEST["x"]) && isset($_REQUEST["sError"])) {
    echo "<script> let x = " . $_REQUEST["x"] . ";
        let sMsg = ". $_REQUEST["sError"] .";</script>";
}else {
    echo "<script> let x = 0;</script>";
}
?>
<main>
    <section id="Ix">
        <h2>Inicie Sesión</h2>
        <form id="frm" method="post" action="login.php">
            <label for="Nm">Usuario</label><input type="text" name="txtCve" id="Nm" required = "true">
            <label for="Pw">Contrase&ntilde;a</label><input type="password" name="txtPwd" id="Pw" required="true">
            <input type="submit" value="Enviar" id="En">
        </form>
    </section>
<?php
include_once("aside.html");
include_once("footer.html");
?>