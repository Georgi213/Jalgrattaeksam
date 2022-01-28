<?php
$servernimi='localhost';
$kasutajanimi='blinov';
$parool='12345';
$admebaasinimi='blinov';
$yhendus=new mysqli($servernimi,$kasutajanimi,$parool,$admebaasinimi);
$yhendus->set_charset('utf8');
//PHP lõpumärki pole vaja, et kogemata midagi välja ei trükitaks
?>
