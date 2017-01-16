<?php
    
    session_start();

    include"db_actions.php";

    $whichProperty = $_POST['whichProperty']; 

    $conn = getConn();

    switch($whichProperty) {
        case 'admin':
            if (isset($_POST['benutzername']) && isset($_POST['passwort'])) {
                $benutzername = $_POST['benutzername'];
                $passwort = $_POST['passwort'];
                createAdmin($conn, $benutzername, $passwort);
            } else {
                $_SESSION['errortext'] = "Beim hinzufügen des neuen Admins ist ein Fehler aufgetreten (Bitte füllen Sie alle Felder aus)...";
                header("Location:errorsite.php");
            }
            break;
        case 'bauherr':
            if (isset($_POST['name']) && isset($_POST['vorname']) && isset($_POST['namenszusatz']) && isset($_POST['adresse']) && isset($_POST['adresszusatz']) && isset($_POST['plz']) && isset($_POST['ort']) && isset($_POST['gender'])) {
                $bhName = $_POST['name'];
                $bhVorname = $_POST['vorname'];
                $bhNamenszusatz = $_POST['namenszusatz'];
                $bhAdresse = $_POST['adresse'];
                $bhAdresszusatz = $_POST['adresszusatz'];
                $bhPlz = $_POST['plz'];
                $bhOrt = $_POST['ort'];
                $bhGender = $_POST['gender'];
                createBauherr($conn, $bhName, $bhVorname, $bhNamenszusatz, $bhAdresse, $bhAdresszusatz, $bhPlz, $bhOrt, $bhGender);
            } else {
                $_SESSION['errortext'] = "Beim hinzufügen des neuen Bauherrs ist ein Fehler aufgetreten (Bitte füllen Sie alle Felder aus)...";
                header("Location:errorsite.php");
            }
            break;
        case 'behoerde':
            if (isset($_POST['name']) && isset($_POST['bgdat']) && isset($_POST['bgnr']) && isset($_POST['adresse']) && isset($_POST['ort']) && isset($_POST['plz'])) {
                $behoerdeName = $_POST['name'];
                $behoerdeAdr = $_POST['adresse'];
                $behoerdePlz = $_POST['plz'];
                $behoerdeOrt = $_POST['ort'];
                $behoerdeBgNr = $_POST['bgnr'];
                $behoerdeBgDat = $_POST['bgdat'];
                createBehoerde($conn, $behoerdeName, $behoerdeAdr, $behoerdePlz, $behoerdeOrt, $behoerdeBgNr, $behoerdeBgDat);
            } else {
                $_SESSION['errortext'] = "Beim hinzufügen der neuen Behörde ist ein Fehler aufgetreten (Bitte füllen Sie alle Felder aus)...";
                header("Location:errorsite.php");
            }
            break;
        case 'objektart':
            if (isset($_POST['objektart'])) {
                $objektart = $_POST['objektart'];
                createObjektart($conn, $objektart);
            } else {
                $_SESSION['errortext'] = "Beim hinzufügen der neuen Objektart ist ein Fehler aufgetreten (Bitte füllen Sie alle Felder aus)...";
                header("Location:errorsite.php");
            }
            break;
        case 'projektart':
            if (isset($_POST['projektart'])) {
                $objektart = $_POST['projektart'];
                createProjektart($conn, $objektart);
            } else {
                $_SESSION['errortext'] = "Beim hinzufügen der neuen Projektart ist ein Fehler aufgetreten (Bitte füllen Sie alle Felder aus)...";
                header("Location:errorsite.php");
            }
            break;
        case 'sachbearbeiter';
            if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['telefon'])) {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $tel = $_POST['telefon'];
                createSachbearbeiter($conn, $name, $email, $tel);
            } else {
                $_SESSION['errortext'] = "Beim hinzufügen des neuen Sachbearbeiters ist ein Fehler aufgetreten (Bitte füllen Sie alle Felder aus)...";
                header("Location:errorsite.php");
            }
            break;
        default:
            $_SESSION['errortext'] = "Die von Ihnen gewählte Eigenschaft wurde noch nicht oder falsch implementiert.";
            header("Location:errorsite.php");
            break;
    }

    $conn->close();
    header("Location:index.php");

?>