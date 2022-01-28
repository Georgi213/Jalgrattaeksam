<?php
require_once("konf.php");
global $yhendus;
session_start();
if(!empty($_REQUEST["korras_id"])){
    $kask=$yhendus->prepare(
        "UPDATE jalgrattaeksam SET slaalom=1 WHERE id=?");
    $kask->bind_param("i", $_REQUEST["korras_id"]);
    $kask->execute();
}
if(!empty($_REQUEST["vigane_id"])){
    $kask=$yhendus->prepare(
        "UPDATE jalgrattaeksam SET slaalom=2 WHERE id=?");
    $kask->bind_param("i", $_REQUEST["vigane_id"]);
    $kask->execute();
}
$kask=$yhendus->prepare("SELECT id, eesnimi, perekonnanimi 
     FROM jalgrattaeksam WHERE teooriatulemus>=10 AND slaalom=-1");
$kask->bind_result($id, $eesnimi, $perekonnanimi);
$kask->execute();
?>
<!doctype html>
<html>
<head>
    <title>Slaalom</title>
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
<div class="header"><h1>Slaalom</h1></div>
<?php include("navigation.php");
if($_SESSION['admin']==true) {
?>
<table>
    <?php
    while($kask->fetch()){
        echo "
		    <tr>
			  <td>$eesnimi</td>
			  <td>$perekonnanimi</td>
			  <td>
			    <a href='?korras_id=$id'>Korras</a>
			    <a href='?vigane_id=$id'>Ebaõnnestunud</a>
			  </td>
			</tr>
		  ";
    }
    ?>
</table>
<?php
}
if($_SESSION['admin']==false) {
    echo"<p>Seda lehte vaadata ainult administraator</p>";
}?>
</body>
<?php include("footer.php");
?>
</html>

