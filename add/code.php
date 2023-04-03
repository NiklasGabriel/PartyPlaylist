<?php 
// User Season
session_start();
if(!isset($_SESSION['userid'])) {
    echo "<script>window.location.href='login.php'</script>";
}
$username = $_SESSION['userid'];

// Dafault Variables
$errorMessage = "";

// Verbindung zur Datenbank
$db_name = '../db.db';
$server = "sqlite:$db_name";
$verbindung = new PDO($server);

if(isset($_GET['change'])) {
    $code = $_POST['code'];
    
    $sql_befehl = "SELECT * FROM users WHERE username = '$username'";
    $statement = $verbindung->prepare($sql_befehl);
    $statement->execute();
    $user = $statement->fetch();
    
    //Überprüfung des Passworts
    //if ($user !== false && password_verify($passwort, $user['passwort'])) {
    $code_hash = password_hash($code, PASSWORD_DEFAULT);
    $verbindung->exec("UPDATE `users`
    SET
        `code` = '$code_hash'
    WHERE
        `username` = '$username'");
    
    echo "<script>window.location.href='../add_choose.php'</script>";
    
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?php include("../extra/head.php");?>
</head>
<body>
    <?php include("../extra/menu.php");?>
    <div class="content">
        <div class="login_div">
            <form class="login_form" action="?change=1" method="post">
                <h1>Code</h1>
                <?php echo("<p class='error_msg'>" . $errorMessage . "</p><br>")?>
                <input type="number" name="code" placeholder="Code"><br><br><br>
                <button onklick="submit()">Code ändern</button><br><br>
            </form>
        </div>
    </div>
</body>
</html>