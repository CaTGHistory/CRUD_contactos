<?php
include_once("model/User.php");
?>

<nav>
    <?php
    if (isset($_SESSION["tipo"])) {
        if ($_SESSION["tipo"] == "Administrador") {

        }
        ?>
        <ul>
            <li><a href="mostrarcon.php">Contactos</a></li>
            <li><a href="logout.php">Salir</a></li>
        </ul>
        <ul id="ss">
            <li><?php echo $_SESSION["usu"]->getName();?></li>
            <li>#<?php echo $_SESSION["usu"]->getType() == User::ADMIN_USER ? 'Administrador' : 'Usuario';?></li>
        </ul>
        <?php
    } else {
        ?>
        <ul>
            <li><a href="#">Inicio</a></li>
        </ul>
        <ul id="ss">
            <li>Inicie Sesi&otilde;n</li>
        </ul>
        <?php
    }
    ?>

</nav>