<?php
// User Season
session_start();
if(!isset($_SESSION['userid'])) {
    echo "<script>window.location.href='../login.php'</script>";
}
$username = $_SESSION['userid'];

//Dafault Variables

?>
<!DOCTYPE html>
<html lang="de">
<head>
	<?php include("../extra/head.php");?>
	<?php
		if (isset($_POST['titel']) || isset($_POST['notitz'])) {
			$titel = $_POST['titel'];
			$notitz = $_POST['notitz'];

			// Verbindung zur Datenbank
			$db_name = '../playlist.db';
			$server = "sqlite:$db_name";
			$verbindung = new PDO($server);

			// Daten überprüfen
			if ($titel == "" and $notitz == "") {
				$message = "Text eintragen!";
			} else {
				// Daten eintragen
				$verbindung->exec(
				"INSERT INTO $username
					(titel, notitz)
				VALUES
					('$titel', '$notitz')"
				);
			}
		}
	?>
</head>
<body>
	<div class="content">		
		<a class="go_back_link" href="../add_choose.php"><img class="go_back_icon" src="../img/arrow_back.png"> Zurück</a><br>
		<div class="new_song">
			<h1>Song hinzufügen</h1><br><br>
			<form class="add_form" action="" method="POST">
				<input class="form_input" type="text" name="titel" placeholder="Titel"><br><br>
				<input class="form_input" type="text" name="notitz" placeholder="Künstler, Band, Notitz"><br><br><br>
				<button class="form_btn" onclick="submit()">Hinzufügen</button>				
			</form>
		</div>
	</div>
</body>
</html>