<?php 
session_start();

// Aus locken, wenn angemeldet
if(isset($_SESSION['userid'])) {
    session_unset();
}

// Verbindung zur Datenbank
$db_name = 'db.db';
$server = "sqlite:$db_name";
$verbindung = new PDO($server);

// Standart Vaiablen
$errorMessage = "";

if(isset($_GET['login'])) {
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];
    
    $sql_befehl = "SELECT * FROM users WHERE email = '$email'";
    $statement = $verbindung->prepare($sql_befehl);
    $statement->execute();
    $user = $statement->fetch();
    
    //Überprüfung des Passworts
    if ($user !== false && password_verify($passwort, $user['passwort'])) {
    //$passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
    //if ($user !== false && $passwort_hash = $user['passwort']) {
        $_SESSION['userid'] = $user['username'];
        echo "<script>window.location.href='playlist.php'</script>";
    } else {
        $errorMessage = "E-Mail oder Passwort war ungültig.";
    }
    
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?php include("extra/head.php");?>
</head>
<body>
    <?php include("extra/menu.php");?>
    <div class="content">
        <div class="login_div">
            <form class="login_form" action="?login=1" method="post">
                <h1>Log In</h1>
                <?php echo("<p class='error_msg'>" . $errorMessage . "</p><br>")?>
                <input type="email" name="email" placeholder="E-Mail"><br><br>
                <input type="password" name="passwort" placeholder="Passwort"><br><br><br>
                <button onklick="submit()">Anmelden</button><br><br><br>
                <a href="registrieren.php">
                Noch keinen Account?<br>
                Hier geht's zur Registrierung...
                </a>
                <br>
            </form>
        </div>
    </div>
</body>
</html>