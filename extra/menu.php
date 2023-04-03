<body>
    <div class="menu">
        <img class="burger" onclick="myFunction()" src="http://109.250.44.14/~Niklas/g-web/img/Hamburger.png" alt="">
        <script>
            function myFunction() {
                var x = document.getElementById("menuPhone");
                if (x.style.display === "block") {
                    x.style.display = "none";
                } else {
                    x.style.display = "block";
                }
            }
        </script>
        <?php
            if(isset($_SESSION['userid'])) {
                $locker = "Log Out";
            } else {
                $locker = "Log In";
            }
        ?>
    
        <div id="menuPhone">
            <a href="http://109.250.44.14/~Niklas/partyplaylist/index.php">Home</a>
            <a href="http://109.250.44.14/~Niklas/partyplaylist/playlist.php">My Playlist</a>
            <a href="http://109.250.44.14/~Niklas/partyplaylist/login.php"><?php echo $locker;?></a>
        </div>
        <table id="menuPC">
            <tr>
                <td id="menuPC_header"><h1>PPList</h1></td>
                <td id="menuPC_links">
                    <a href="http://nweb.freeddns.org/~Niklas/partyplaylist/index.php">Home</a>
                    <a href="http://nweb.freeddns.org/~Niklas/partyplaylist/playlist.php">My Playlist</a>
                    <a href="http://nweb.freeddns.org/~Niklas/partyplaylist/login.php"><?php echo $locker;?></a>
                </td>
            </tr>
        </table>
    </div>
</body>