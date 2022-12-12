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
</head>
<body>
    <?php include("extra/menu.php");?>
    <div class="content">
        <div class="add_choose_div">
            <div class="choose_div">
                <h1>Zur Eingabe</h1>
                <div class="add_choose">
                    <button class="choose_btn" onclick="window.location.href='add/add_own.php'">Eingabe auf diesem Gerät</button><br>
                    <button class="choose_btn" onclick="window.location.href='add/add_own_qr.php'">Eingabe auf diesem Gerät mit QR-Code</button><br>
                    <button class="choose_btn" onclick="window.location.href='add/add_guest.php?username=<?php echo $username?>'">Eingabe auf Endgerät von Gast (Link aus QR-Code)</button><br>
                    <button class="choose_btn" onclick="window.location.href='add/add_qr.php'">QR-Code</button><br><br><br>
                    <button class="choose_btn" onclick="window.location.href='add/code.php'">Code für Gäste ändern</button><br>
                </div>
                <br>
            </div>
        </div>
    </div>
</body>
</html>