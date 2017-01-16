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
                <input type="hidden" name="whichProperty" value="behoerde">
                <input type="textbox" name="name" placeholder="Behörde Name" class="input"><br><br>
                <input type="textbox" name="adresse" placeholder="Behörde Adresse" class="input"><br><br>
                <input type="textbox" name="plz" placeholder="Behörde PLZ" class="input"><br><br>
                <input type="textbox" name="ort" placeholder="Behörde Ort" class="input"><br><br>
                <input type="textbox" name="bgnr" placeholder="Behörde BG-Nummer" class="input"><br><br>
                <input type="textbox" name="bgdat" placeholder="Behörde Eingangsdatum" class="input"><br><br>
                <input type="submit" class="button" value="Hinzufügen">
            </form>
        </div>
        <footer>
            <p>Designed and developed by Joel Häberli</p>
        </footer>
    </body>
</html>