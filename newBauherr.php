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
                <input type="hidden" name="whichProperty" value="bauherr">
                <input type="textbox" name="name" placeholder="Bauherr Name" class="input"><br><br>
                <input type="textbox" name="vorname" placeholder="Bauherr Vorname" class="input"><br><br>
                <input type="textbox" name="namenszusatz" placeholder="Bauherr Namenszusatz" class="input"><br><br>
                <input type="textbox" name="adresse" placeholder="Bauherr Adresse" class="input"><br><br>
                <input type="textbox" name="adresszusatz" placeholder="Bauherr Adresszusatz" class="input"><br><br>
                <input type="textbox" name="plz" placeholder="Bauherr PLZ" class="input"><br><br>
                <input type="textbox" name="ort" placeholder="Bauherr Ort" class="input"><br><br>
                <input type="radio" name="gender" value="Mann" class="input">Mann<br>
                <input type="radio" name="gender" value="Frau" class="input">Frau<br><br>
                <input type="submit" class="button" value="Hinzufügen">
            </form>
        </div>
        <footer>
            <p>Designed and developed by Joel Häberli</p>
        </footer>
    </body>
</html>