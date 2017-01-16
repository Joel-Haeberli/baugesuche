<!DOCTYPE html>
<html>
    <head>
       <!-- Loginseite -->
       <?php
        session_start();
        include"db_actions.php";
        include"selectionGenerator.php";

        $conn = getConn();
       ?>
       <link rel="stylesheet" href="design_all.css">
       <link rel="stylesheet" href="design_newProject.css">
    </head>
    <body>
        <div id="navigation">
            <?php
                include"loadNavigation.php";
            ?>
        </div>
        <div id="loginSpace">
            <form method="POST" action="createNewProject.php">
                <div id="left">
                    <input type="textbox" name="bgnresag" placeholder="BG-Nummer ESAG" class="input"><br><br>
                    <input type="textbox" name="bgEingang" placeholder="BG-Eingang ESAG" class="input"><br><br>
                    <?php selectionSachbearbeiter($conn); ?><br><br>
                    <input type="textbox" name="standortAdresse" placeholder="Standort Adresse" class="input"><br><br>
                    <input type="textbox" name="standortParzelle" placeholder="Standort Parzelle" class="input"><br><br>
                    <input type="textbox" name="standortPlz" placeholder="Standort PLZ" class="input"><br><br>
                    <input type="textbox" name="standortOrt" placeholder="Standort Ort" class="input"><br><br>
                    <input type="textbox" name="standortOrtsteil" placeholder="Standort Ortsteil" class="input"><br><br>
                    <?php selectionBehoerde($conn); ?><br><br>
                    <?php selectionBauherr($conn); ?><br><br>
                    <input type="textbox" name="bhAnsprechperson" placeholder="Bauherr Ansprechperson" class="input"><br><br>
                    <?php selectionObjektart($conn);  ?><br><br>
                    <?php selectionProjektart($conn); ?><br><br>
                    <input type="textbox" name="anzahlWeAlt" placeholder="Anzahl WE alt" class="input"><br><br>
                    <input type="textbox" name="anzahlWeNeu" placeholder="Anzahl WE neu" class="input"><br><br>
                </div>
                <div id="right">
                    <input type="textbox" name="bgfAlt" placeholder="BGF alt (m2)" class="input"><br><br>
                    <input type="textbox" name="bgfNeu" placeholder="BGF neu (m2)" class="input"><br><br>
                    <input type="textbox" name="pvName" placeholder="Projektverfasser Name" class="input"><br><br>
                    <input type="textbox" name="pvVorname" placeholder="Projektverfasser Vorname" class="input"><br><br>
                    <input type="textbox" name="pvNamenszusatz" placeholder="Projektverfasser Namenszusatz" class="input"><br><br>
                    <input type="textbox" name="pvAdresse" placeholder="Projektverfasser Adresse" class="input"><br><br>
                    <input type="textbox" name="pvAdresszusatz" placeholder="Projektverfasser Adresszusatz" class="input"><br><br>
                    <input type="textbox" name="pvPlz" placeholder="Projektverfasser PLZ" class="input"><br><br>
                    <input type="textbox" name="pvOrt" placeholder="Projektverfasser Ort" class="input"><br><br>
                    <input type="radio" name="pvGender" value="Mann" class="input" default>Projektverfasser ist Mann<br>
                    <input type="radio" name="pvGender" value="Frau" class="input">Projektverfasserin ist Frau<br><br>
                    <input type="textbox" name="pvAnsprechperson" placeholder="Projektverfasser Ansprechperson" class="input"><br><br>
                    <input type="submit" class="button" value="Projekt generieren">
                </div>
            </form>
        </div>
        <footer>
            <p>Designed and developed by Joel Häberli</p>
        </footer>
    </body>
</html>