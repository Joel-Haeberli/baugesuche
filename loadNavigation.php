<?php
    //zeigt die Navigation an
    //setzt ein session_start() auf aufrufender Seite voraus
              echo("<div id='logo'>
                    <p>Energie Seeland - ESAG</p>
                    <p>Baugesuche</p>
                    <form method='POST' action='index.php' style='margin-bottom:2%; width:100%;'>
                        <input type='submit' value='Start' class='navigationButton'>
                    </form>");
              if ($_SESSION['username'] == "gast") {
                echo ("<form method='POST' action='login.php'>
                        <input type='submit' value='Login' class='navigationButton'>
                        </form>");
                } else {
                echo ("<form method='POST' action='logout.php'>
                        <input type='submit' value='Logout' class='navigationButton'>
                        </form>");
              }
              echo("</div>");
        if (!($_SESSION['username'] == "gast")) {
              echo('<nav><form method="POST" action="newProject.php" style="margin-bottom:2%;">
                    <button type="submit" class="navigationButton">Neues Projekt</button>
                    </form><br>
                    <form method="POST" action="newObjektart.php" style="margin-bottom:2%;">
                    <button type="submit" class="navigationButton">Neue Objektart</button>
                    </form>
                    <form method="POST" action="newProjektart.php" style="margin-bottom:2%;">
                    <button type="submit" class="navigationButton">Neue Projektart</button>
                    </form>
                    <form method="POST" action="newBauherr.php" style="margin-bottom:2%;">
                    <button type="submit" class="navigationButton">Neuer Bauherr</button>
                    </form>
                    <form method="POST" action="newBehoerde.php" style="margin-bottom:2%;">
                    <button type="submit" class="navigationButton">Neue Behörde</button>
                    </form>
                    <form method="POST" action="newSachbearbeiter.php" style="margin-bottom:2%;">
                    <button type="submit" class="navigationButton">Neuer Sachbearbeiter</button>
                    </form>
                    <form method="POST" action="newAdmin.php" style="margin-bottom:2%;">
                    <button type="submit" class="navigationButton">Neuer Administrator</button>
                    </form></nav>');
            }
?>