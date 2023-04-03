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
</head>
<body>
	<div class="content">		
		<a class="go_back_link" href="../add_choose.php"><img class="go_back_icon" src="../img/arrow_back.png"> Zurück</a><br>
		<div class="new_song">
			<h1>Song hinzufügen</h1><br><br>
			<img class="qr_without" src="https://qrcode.tec-it.com/API/QRCode?data=http%3a%2f%2f109.250.44.14%2f~Niklas%2fplaylist%2fadd%2fadd_guest.php?username=<?php echo $username?>&istransparent=true"/>
		</div>
	</div>
</body>
</html>