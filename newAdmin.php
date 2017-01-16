<!DOCTYPE html>
<html>
    <head>
       <!-- Loginseite -->
       <?php
        session_start();
       ?>
       <link rel="stylesheet" href="design_all.css">
       <link rel="stylesheet" href="design_login.css">
    </head>
    <body>
        <div id="navigation">
            <?php
                include"loadNavigation.php";
            ?>
        </div>
        <div id="loginSpace">
            <form method="POST" action="addProperty.php">
                <input type="hidden" name="whichProperty" value="admin">
                <input type="textbox" name="benutzername" placeholder="Benutzername" class="input"><br><br>
                <input type="password" name="passwort" placeholder="Passwort" class="input"><br><br>
                <input type="submit" class="button" value="Hinzufügen">
            </form>
        </div>
        <footer>
            <p>Designed and developed by Joel Häberli</p>
        </footer>
    </body>
</html>