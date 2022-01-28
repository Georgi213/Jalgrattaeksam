<?php
require_once("konf.php");
global $yhendus;
session_start();
$kask=$yhendus->prepare(
    "SELECT id, eesnimi, perekonnanimi, teooriatulemus, 
	     slaalom, ringtee, t2nav, luba FROM jalgrattaeksam;");
$kask->bind_result($id, $eesnimi, $perekonnanimi, $teooriatulemus,
    $slaalom, $ringtee, $t2nav, $luba);
$kask->execute();
?>
<!doctype html>
<html>
<head>
    <title>Lõpetamine</title>
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
<div class="header"><h1>Tänavasõidueksam</h1></div>
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
			   <td>$teooriatulemus</td>
			   <td>$slaalom</td>
			   <td>$ringtee</td>
			   <td>$t2nav</td>
			   <td>$luba</td>
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

