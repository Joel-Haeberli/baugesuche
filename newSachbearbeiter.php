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
                <input type="hidden" name="whichProperty" value="sachbearbeiter">
                <input type="textbox" name="name" placeholder="Name" class="input"><br><br>
                <input type="textbox" name="email" placeholder="E-Mail" class="input"><br><br>
                <input type="textbox" name="telefon" placeholder="Telefon" class="input"><br><br>
                <input type="submit" class="button" value="Hinzufügen">
            </form>
        </div>
        <footer>
            <p>Designed and developed by Joel Häberli</p>
        </footer>
    </body>
</html>