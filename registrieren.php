<?php 
session_start();

// Verbindung zur Datenbank
$db_name = 'db.db';
$server = "sqlite:$db_name";
$verbindung = new PDO($server);

// Verbindung zur Datenbank
$db_name = 'playlist.db';
$server = "sqlite:$db_name";
$verbindung_playlist = new PDO($server);
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?php include("extra/head.php");?>
</head>
<body>
    <?php include("extra/menu.php");?>
    <?php

    // Formular Abschicken
    if(isset($_GET['register'])) {
        $error = false;
        $username = $_POST['username'];
        $email = $_POST['email'];
        $passwort1 = $_POST['password1'];
        $passwort2 = $_POST['password2'];
        
        // Eingaben überprüfen
        if(strlen($username) == 0) {
            $errorMessage = 'Bitte einen Benutzernamen angeben.';
            $error = true;
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMessage = 'Bitte eine gültige E-Mail-Adresse eingeben.';
            $error = true;
        }     
        if(strlen($passwort1) == 0) {
            $errorMessage = 'Bitte ein Passwort angeben.';
            $error = true;
        }
        if($passwort1 != $passwort2) {
            $errorMessage = 'Die Passwörter müssen übereinstimmen.';
            $error = true;
        }

        //Überprüfe, dass der Benutzername noch nicht registriert wurde
        if(!$error) { 
            $statement = $verbindung->prepare("SELECT * FROM users WHERE username = '$username'");
            $result = $statement->execute();
            $user = $statement->fetch();
            
            if($user !== false) {
                $errorMessage = 'Dieser Benutzername ist bereits vergeben.';
                $error = true;
            }    
        }
        
        //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
        if(!$error) { 
            $statement = $verbindung->prepare("SELECT * FROM users WHERE email = '$email'");
            $result = $statement->execute();
            $user = $statement->fetch();
            
            if($user !== false) {
                $errorMessage = 'Diese E-Mail Adresse ist bereits vergeben.';
                $error = true;
            }    
        }
        
        //Keine Fehler, wir können den Nutzer registrieren
        if(!$error) {
            $passwort_hash = password_hash($passwort1, PASSWORD_DEFAULT);
            $verbindung->exec("INSERT INTO users (username, email, passwort) VALUES ('$username', '$email', '$passwort_hash')");

            $verbindung_playlist->exec(
            "CREATE TABLE '$username' (
                'titel' TEXT,
                'notitz' TEXT
            )"
            );
            

            echo "<script>window.location.href='login.php'</script>";
        } 
    }
    ?>
    <div class="content">
        <div class="login_div">
            <form class="login_form" action="?register=1" method="post">
                <h1>Registrieren</h1><br>
                <?php echo("<p class='error_msg'>" . $errorMessage . "</p><br>")?>
                <input id="username" type="text" name="username" placeholder="Benutzername"><br><br>
                <input id="email" type="email" name="email" placeholder="E-Mail"><br><br>
                <input id="password1" type="password" name="password1" placeholder="Passwort"><br><br>
                <input id="password2" type="password" name="password2" placeholder="Passwort wiederholen"><br><br><br>
                <button onklick="submit()">Anmelden</button><br><br><br>
                <a href="login.php">
                Schon einen Account?<br>
                Hier geht's zum Log In...
                </a>
                <br>
            </form>
        </div>
    </div>
</body>
</html>