<?php
session_start();
require_once("konf.php");
global $yhendus;

// kontroll kas login vorm on täidetud?
if(isset($_REQUEST['knimi']) && isset($_REQUEST['psw'])) {
$login = htmlspecialchars($_REQUEST['knimi']);
$pass = htmlspecialchars($_REQUEST['psw']);

$sool = 'vagavagatekst';
$krypt = crypt($pass, $sool);
// kontrollime kas andmebaasis on selline kasutaja

$kask = $yhendus->prepare("SELECT id, knimi, psw, isadmin FROM uuedkasutajad WHERE knimi=? AND psw=?");
$kask->bind_param("ss", $login, $krypt);
$kask->bind_result($id, $knimi, $psw, $isadmin);
$kask->execute();

    if ($kask->fetch() && $krypt == $psw) {
        header("Location: teooriaeksam.php");
        $_SESSION['knimi'] = $login;
        if ($isadmin == 1) {
            $_SESSION['admin'] = true;
        }
        else if ($isadmin == 0) {
            $_SESSION['admin'] = false;
        }
        $yhendus->close();
        exit();
    }
    echo "knimi $login või psw $krypt on vale";
    $yhendus->close();
}

?>
<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css" type="text/css">
</head>
<body>
<h1>Login vorm</h1>
<form action="login.php" method="post">
        <div class="container">
            <label for="knimi">Kasutajanimi</label>
            <input type="text" placeholder="Sisesta kasutajanimi"
                   name="knimi" id="knimi" required>
            <br>
            <label for="psw">Parool</label>
            <input type="password" placeholder="Sisesta parool"
                   name="psw" id="psw" required>
            <br>
            <br>
            <input type="submit" value="Logi sisse">
            <button type="button" onclick="window.location.href='avaleht.php'" ;="" class="cancelbtn">Cancel</button>
        </div>
</form>
</body>
</html>