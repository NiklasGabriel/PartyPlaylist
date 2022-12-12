<?php
session_start();
?>
<!DOCTYPE html>
<html lang="de">
<head>
	<?php include("../extra/head.php");?>
	<?php
		$username = $_GET['username'];
	?>
	<?php
		// Verbindung zur Datenbank
		$db_name = '../db.db';
		$server = "sqlite:$db_name";
		$verbindung = new PDO($server);

		if(isset($_GET['code'])) {
			$code = $_POST['code'];
			
			$sql_befehl = "SELECT * FROM users WHERE username = '$username'";
			$statement = $verbindung->prepare($sql_befehl);
			$statement->execute();
			$user = $statement->fetch();

			//Überprüfung des Passworts
			if ($user !== false && password_verify($code, $user['code'])) {
				$_SESSION['guestid'] = $user['code'];
				echo "<script>window.location.href='?username=" . $username ."'</script>";
			} else {
				$errorMessage = "Code war falsch!";
			}
			
		}	
	?>
	<?php
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
	?>
</head>
<body>
	<div class="content">
		<?php
		if(!isset($_SESSION['guestid'])) {
		?>
			<br><br>
			<div class="login_div">
				<form class="login_form" action="?username=<?php echo $username?>&code=1" method="post">
					<h1>Identität</h1>
					<?php echo("<p class='error_msg'>" . $errorMessage . "</p><br>")?>
					<input type="number" name="code" placeholder="Code"><br><br><br>
					<button onklick="submit()">Anmelden</button><br>
					<br>
				</form>
			</div>
		<?php
		}
		?>

		<?php
		if(isset($_SESSION['guestid'])) {
		?>
			<div class="new_song">
				<h1>Song hinzufügen</h1><br><br>
				<form class="add_form" action="" method="POST">
					<input class="form_input" type="text" name="titel" placeholder="Titel"><br><br>
					<input class="form_input" type="text" name="notitz" placeholder="Künstler, Band, Notitz"><br><br><br>
					<button class="form_btn" onclick="submit()">Hinzufügen</button>
				</form>
			</div>
		<?php
		}
		?>
		
	</div>
</body>
</html>