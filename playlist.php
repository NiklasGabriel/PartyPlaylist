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
    <?php // DB Abfrage
	// Verbindung zur Datenbank
    $db_name = 'playlist.db';
	$server = "sqlite:$db_name";
	$verbindung = new PDO($server);

	// Datenbankabfrage
	$sql_befehl = "SELECT * FROM $username";
	$abfrage = $verbindung->prepare($sql_befehl);
	$abfrage->execute(); 
	$ergebnismenge = $abfrage->fetchAll();
	?>
</head>
<body>
    <?php include("extra/menu.php");?>
    <div class="content">
        <div class="playlist">
			<table>
				<tr>
					<td><h1 class="main_header">Playlist - <?php echo $_SESSION['userid']?></h1></td>
					<td class="header_table_link"><a class="go_entry_link" href="add_choose.php">Zur Eingabe <img class="go_entry_icon" src="img/arrow_to.png"></a></td>
				</tr>
			</table>
            <br>
			<table class="uebersicht_titel">
				<thead>
					<tr>
						<th>Titel</th>
						<th>Notitz</th>
						<th>Löschen</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($ergebnismenge as $zeile) {?>
						<tr>
							<td><?php echo $zeile["titel"]?></td>
							<td><?php echo $zeile["notitz"]?></td>
							<td class="td_löschen"><button class="table_btn" onclick="window.location.href='delete.php?titel=<?php echo $zeile['titel']?>&notitz=<?php echo $zeile['notitz']?>'">Löschen</button></td>
						</tr>
					<?php }?>
				</tbody>
			</table>
		</div>
    </div>
</body>
</html>