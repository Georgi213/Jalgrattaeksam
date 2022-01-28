<?php
session_start();
require_once("konf.php");
global $yhendus;
if(!empty($_REQUEST["eesnimi"]) && !empty(($_REQUEST["perekonnanimi"]))){
    if(isSet($_REQUEST["sisestusnupp"])){
        $kask=$yhendus->prepare(
            "INSERT INTO jalgrattaeksam(eesnimi, perekonnanimi) VALUES (?, ?)");
        $kask->bind_param("ss", $_REQUEST["eesnimi"], $_REQUEST["perekonnanimi"]);
        $kask->execute();
        $yhendus->close();
        header("Location: $_SERVER[PHP_SELF]?lisatudeesnimi=$_REQUEST[eesnimi]");
        exit();
    }
}

?>
<!doctype html>
<html>
<head>
    <title>Kasutaja registreerimine</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
<div id="menuArea">
    <?php
    if(isset($_SESSION['knimi'])){
        ?>
        <a href="logout.php">Logi välja</a>
        <h1>Tere, <?="$_SESSION[knimi]"?></h1>
        <?php
    }
    else {
        ?>
        <a href="login.php">Logi sisse</a>
        <?php
    }
    ?>
</div>
<div class="header"><h1>Registreerimine</h1></div>
<?php include("navigation.php");
?>
<?php
if(isSet($_REQUEST["lisatudeesnimi"])){
    echo "Lisati $_REQUEST[lisatudeesnimi]";
    ?>
    <br> <a href="lubadeleht.php">Vaata Lõpetamine</a>
<?php }
if($_SESSION['admin']==false) {
    echo'<form action="?">
    <dl>
        <dt>Eesnimi:</dt>
        <dd><input type="text" name="eesnimi" /></dd>
        <dt>Perekonnanimi:</dt>
        <dd><input type="text" name="perekonnanimi" /></dd>
        <dt><input type="submit" name="sisestusnupp" value="sisesta" /></dt>
    </dl>
</form>';
}
if($_SESSION['admin']==true) {
    ?>
    <p>Registreeruga saavad ainult õpilased</p>
    <?php
}?>
</body>
<?php include("footer.php");
?>
</html>