<?php
require_once("konf.php");
global $yhendus;
session_start();
if(!empty($_REQUEST["teooriatulemus"])){
    $kask=$yhendus->prepare(
        "UPDATE jalgrattaeksam SET teooriatulemus=? WHERE id=?");
    $kask->bind_param("ii", $_REQUEST["teooriatulemus"], $_REQUEST["id"]);
    $kask->execute();
}
function kustutaKaup($teavet_id){
    global $yhendus;
    $kask=$yhendus->prepare("DELETE FROM jalgrattaeksam WHERE id=?");
    $kask->bind_param("i", $teavet_id);
    $kask->execute();
}
if(isSet($_REQUEST["kustutusid"])){
    kustutaKaup($_REQUEST["kustutusid"]);
}
$kask=$yhendus->prepare("SELECT id, eesnimi, perekonnanimi 
     FROM jalgrattaeksam WHERE teooriatulemus=-1");
$kask->bind_result($id, $eesnimi, $perekonnanimi);
$kask->execute();
if(isset($_REQUEST['kustuta'])){
    $kask=$yhendus->prepare("DELETE FROM jalgrattaeksam WHERE id=?");
    $kask->bind_param("i",$_REQUEST['kustuta']);
    $kask->execute();

}

?>
<!doctype html>
<html>
<head>
    <title>Teooriaeksam</title>
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
<div class="header"><h1>Teooriaeksam</h1></div>
<?php include("navigation.php");
if($_SESSION['admin']==true) {
?>

<table>
    <?php
    $txt="Kas sa tahad kustutada see opilane";
    while($kask->fetch()){
        echo "
		    <tr>
			  <td>$eesnimi</td>
			  <td>$perekonnanimi</td>
			  <td><form action=''>
			         <input type='hidden' name='id' value='$id' />
					 <input type='text' name='teooriatulemus' />
					 <input type='submit' value='Sisesta tulemus' />
					 
			      </form>
			  </td>
			  			  

			  <!--<td><a href='?kustuta=$id' onclick='return confirm($txt)'>X</a></td>-->
			</tr>
		  ";
    }
    ?>
</table>
<?php }
if($_SESSION['admin']==false) {
    echo"<p>Seda lehte vaadata ainult administraator</p>";
}?>
</body>
<?php include("footer.php");
?>
</html>

