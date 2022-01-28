<?php
session_start();
if(isSet($_REQUEST["kustutusid"])){
    kustutaKaup($_REQUEST["kustutusid"]);
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
<?php
if(isset($_SESSION['knimi'])){
?>
<td>
    <a href="teooriaeksam.php?kustutusid=<?=$kask->id ?>"
       onclick="return confirm('Kas ikka soovid kustutada?')">x</a>
    <?php }?>
<div class="header"><h1>Avaleht</h1></div>
<?php include("navigation.php");
?>
<h4>Palun registreeruge eksamile</h4><br>
<a href="registreerimine.php">registreerimine</a>
</body>
<?php include("footer.php");
?>
</html>