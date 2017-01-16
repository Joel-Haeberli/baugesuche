<?php
    //Dieses Skript fügt ein neues Projekt hinzu

    //für Fehlermeldungen
    session_start();
    $hasFails = False;
    $_SESSION['errortext'] = "<p>folgende Fehler sind aufgetreten:</p>";

    //DB- Connection aufbauen
    include"db_actions.php";
    $conn = getConn();

    //Alle Formulardaten aus POST lesen
    $bgnresag = $_POST['bgnresag'];
    $bgEingang = $_POST['bgEingang'];
    $sSachbearbeiter = $_POST['sSachbearbeiter'];
    $standortAdresse = $_POST['standortAdresse'];
    $standortParzelle = $_POST['standortParzelle'];
    $standortPlz = $_POST['standortPlz'];
    $standortOrt = $_POST['standortOrt'];
    $standortOrtsteil = $_POST['standortOrtsteil'];
    $sbehoerde = $_POST['sbehoerde'];
    $sbauherr = $_POST['sbauherr'];
    $bhAnsprechperson = $_POST['bhAnsprechperson'];
    $sObjektart = $_POST['sObjektart'];
    $sProjektart = $_POST['sProjektart'];
    $anzahlWeAlt = $_POST['anzahlWeAlt'];
    $anzahlWeNeu = $_POST['anzahlWeNeu'];
    $bgfAlt = $_POST['bgfAlt'];
    $bgfNeu = $_POST['bgfNeu'];
    $pvName = $_POST['pvName'];
    $pvVorname = $_POST['pvVorname'];
    $pvNamenszusatz = $_POST['pvNamenszusatz'];
    $pvAdresse = $_POST['pvAdresse'];
    $pvAdresszusatz = $_POST['pvAdresszusatz'];
    $pvPlz = $_POST['pvPlz'];
    $pvOrt = $_POST['pvOrt'];
    $pvGender = $_POST['pvGender'];
    $pvAnsprechperson = $_POST['pvAnsprechperson'];

    //Eingaben validieren
    if ($sSachbearbeiter == '-1' || $sbehoerde == '-1' || $sbauherr == '-1' || $sObjektart == '-1' || $sProjektart == '-1') {
        $_SESSION['errortext'] .= '<p>Bitte wählen Sie bei allen Dropdown-Listen einen Wert</p>';
        $hasFails = True;
    }

    if (!(isset($_POST['bgnresag'])) || !(isset($_POST['bgEingang'])) || !(isset($_POST['sSachbearbeiter'])) || !(isset($_POST['standortAdresse'])) || !(isset($_POST['standortParzelle'])) || !(isset($_POST['standortPlz'])) || !(isset($_POST['standortOrt'])) || !(isset($_POST['standortOrtsteil'])) || !(isset($_POST['sbehoerde'])) || !(isset($_POST['sbauherr'])) || !(isset($_POST['bhAnsprechperson'])) || !(isset($_POST['sObjektart'])) || !(isset($_POST['sProjektart'])) || !(isset($_POST['anzahlWeAlt'])) || !(isset($_POST['anzahlWeNeu'])) || !(isset($_POST['bgfAlt'])) || !(isset($_POST['bgfNeu'])) || !(isset($_POST['pvName'])) || !(isset($_POST['pvVorname'])) || !(isset($_POST['pvNamenszusatz'])) || !(isset($_POST['pvAdresse'])) || !(isset($_POST['pvAdresszusatz'])) || !(isset($_POST['pvPlz'])) || !(isset($_POST['pvOrt'])) || !(isset($_POST['pvGender'])) || !(isset($_POST['pvAnsprechperson']))) {
        $_SESSION['errortext'] .= "<p>Bitte füllen Sie sämtliche Felder mit Angaben. Falls Sie einen Wert nicht haben geben Sie einen Bindestrich ein (-).</p>";
        $hasFails = True;
    }

    if (strlen($pvPlz) != 4 || strlen($standortPlz) != 4) {
        $_SESSION['errortext'] .= "<p>Eine Postleitzahl hat 4 Zahlen</p>";
        $hasFails = True;
    }

    if (strlen($bgnresag) > 6) {
        $_SESSION['errortext'] .= "<p>Die Baugesuchnummer hat nicht mehr als 6 Ziffern</p>";
        $hasFails = True;
    }

    if($hasFails) {
        header("Location:errorsite.php");
    }

    //nummerische String-Eingaben konvertieren
    $sbId = intval($sSachbearbeiter);
    $bewilligungsbehoerde = intval($sbehoerde);
    $bauherrId = intval($sbauherr);
    $objektart = intval($sObjektart);
    $projektart = intval($sProjektart);

    //Eingaben in DB speichern
    createProject($conn, $bgnresag, $bgEingang, $sbId, $standortAdresse, $standortParzelle, $standortPlz, $standortOrt, $standortOrtsteil, $bewilligungsbehoerde, $bauherrId, $bhAnsprechperson, $pvName, $pvVorname, $pvNamenszusatz, $pvAdresse, $pvAdresszusatz, $pvPlz, $pvOrt, $pvGender, $pvAnsprechperson, $objektart, $projektart, $anzahlWeAlt, $anzahlWeNeu, $bgfAlt, $bgfNeu);

    header("Location:index.php");
?>