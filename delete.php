<?php
session_start();
if(!isset($_SESSION['userid'])) {
    echo "<script>window.location.href='login.php'</script>";
}
$username = $_SESSION['userid'];
?>
<!DOCTYPE html>
<html lang="de">
<head>
	<?php include("extra/head.php");?>
	<?php
	
	// Aus Eingabe abrufen
	$titel = $_GET['titel'];
	$notitz = $_GET['notitz'];
	echo($titel . " | " . $notitz . "<br>");

	// nach was sol gelöscht werden
	if ($titel == "") {
		$which = "notitz";
		$deleater = $notitz;
	} else if ($notitz == "") {
		$which = "titel";
		$deleater = $titel;
	} else {
		$which = "titel";
		$deleater = $titel;
	}
	
	// Verbindung zur Datenbank
    $db_name = 'playlist.db';
	$server = "sqlite:$db_name";
	$verbindung = new PDO($server);

	// Daten löschen
	$verbindung->exec(
		"DELETE FROM $username
		WHERE $which = '$deleater'"
		);

	// zurück
	echo "<script>window.location.href='playlist.php'</script>";
	?>
</head>
<body>
	
</body>
</html>