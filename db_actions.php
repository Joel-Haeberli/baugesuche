<?php
    //Diese Seite beinhaltet alle Interaktionen mit der Datenbank
    //Erstellt am: 03.02.2016

    //Die Seite ist in Select-, Insert-, Update- und Deletestatements unterteilt
    
    //Es gibt zudem den Bereich "Asserts". Dieser ist dazu da bestimmte Werte zu prüfen. (z.B. beim Login)
    //Die Funktion getConn() ist sehr essentiel, da jede Funktion dieser Komponente eine Verbindung als Parameter $conn verlangt, welche man mit getConn() bekommt (oder auch nicht ;)...).

    // SETZT EIN session_start() AUF AUFRUFENDER SEITE VORAUS

    /**********************************************************************************************************************/
    //VERBINDUNG
    /**********************************************************************************************************************/
    function getConn() {
        //Verbindungsparameter
        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dbname = "prototyp_dbbg";

        //mysqli-Objekt erstellen welches die Verbindung darstellt
        $connection = new mysqli($servername, $username, $password, $dbname);

        //Verbindung überprüfen
        if ($connection->connect_errno) {
            $_SESSION['errortext'] = "Die Verbindung zur Datenbank konnte nicht hergestellt werden";
            header("Location:errorsite.php");
            $connection->close();
            return NULL;
        } else {
            return $connection;
        }
    }


    /**********************************************************************************************************************/
    //INSERTS
    /**********************************************************************************************************************/

    //Neues Projekt hinzufügen
    function createProject($conn, $bgNrEsag, $bgEingangEsag, $sbId, $adresse, $parzelle, $plz, $ort, $ortsteil, $bewilligungsbehoerde, $bauherrId, $ansprechperson_bh, $name_pv, $vorname_pv, $namenszusatz_pv, $adresse_pv, $adresszusatz_pv, $plz_pv, $ort_pv, $gender_pv, $ansprechperson_pv, $objektart, $projektart, $anzahlWeAlt, $anzahlWeNeu, $bgfAlt, $bgfNeu)
    {
        $conn->query("INSERT INTO projekt (bg_nr_esag, sb_id, standortAdresse, standortParzelle, standortPLZ, standortOrt, standortOrtsteil, bewilligungsbehoerde_id, bauherr_id, bh_ansprechperson, pv_name, pv_vorname, pv_namenszusatz, pv_adresse, pv_adresszusatz, pv_plz, pv_ort, pv_gender, pv_ansprechperson, objektart_id, projektart_id, anzahl_we_alt, anzahl_we_neu, bgf_alt, bgf_neu, bg_eingang, erschliessung_id, kosten_id) VALUES ('$bgNrEsag', '$sbId', '$adresse', '$parzelle', '$plz', '$ort', '$ortsteil', '$bewilligungsbehoerde', '$bauherrId', '$ansprechperson_bh', '$name_pv', '$vorname_pv', '$namenszusatz_pv', '$adresse_pv', '$adresszusatz_pv', '$plz_pv', '$ort_pv', '$gender_pv', '$ansprechperson_pv', '$objektart', '$projektart', '$anzahlWeAlt', '$anzahlWeNeu', '$bgfAlt', '$bgfNeu', '$bgEingangEsag', 0, 0);");
    }

    //Dokument EW Wohnen anlegen
    function createDocEwWohnen($conn, $projectId, $netzanschlusspunkt, $rohrHausanschluss, $querschnittHausanschlussleitung, $absicherungHak, $anschlussleistung, $spezielles)
    {
        //Erschliessung hinzufügen
        $conn->query("INSERT INTO erschliessung (netzanschlusspunkt, rohr_hausanschluss, querschnitt_hausanschlussleitung, absicherung_hak, anschlussleistung, spezielles, projektId) VALUES ('$netzanschlusspunkt','$rohrHausanschluss','$querschnittHausanschlussleitung','$absicherungHak','$anschlussleistung','$spezielles', '$projectId');");

        //ID der Erschliessung ermitteln
        $idErschl = -1;
        if ($result = $conn->query("SELECT idErschliessung FROM erschliessung WHERE projektId='$projectId';")) {
            $row = mysqli_fetch_array($result);
            $idErschl = row['idErschliessung'];
        } else {
            $_SESSION['errortext'] = "Die Erschliessung konnte nicht gespeichert werden oder das Projekt ist nicht (mehr) vorhanden";
            header("Location:errorsite.php");
        }

        //ID mit Methode in Projekt eintragen
        updateProjectAfterErschliessung($conn, $projectId, $idErschl);

    }

    //objektart hinzufügen 
    function createObjektart($conn, $objektartName) {
        $conn->query("INSERT INTO objektart (objektart_bezeichnung) VALUES ('$objektartName');");
    }

    //projektart hinzufügen
    function createProjektart($conn, $projektartName) {
        $conn->query("INSERT INTO projektart (projektart_bezeichnung) VALUES ('$projektartName');");
    }

    //Behörde hinzufügen
    function createBehoerde($conn, $behoerdeName, $behoerdeAdr, $behoerdePlz, $behoerdeOrt, $behoerdeBgNr, $behoerdeBgDat) {
        $conn->query("INSERT INTO bewilligungsbehoerde (bb_name, bb_adresse, bb_plz, bb_ort, bb_bg_nr, bb_bg_dat) VALUES ('$behoerdeName', '$behoerdeAdr', '$behoerdePlz', '$behoerdeOrt', '$behoerdeBgNr', '$behoerdeBgDat');");
    }

    //admin hinzufügen
    function createAdmin($conn, $username, $passwordClear) {
        if (!(usernameForgiven($conn, $username))) {
            $password = password_hash($passwordClear, PASSWORD_BCRYPT);
            $conn->query("INSERT INTO admin (username, pw_hash) VALUES ('$username', '$password');");
        } else {
            $_SESSION['errortext'] = "Dieser Benutzernamen ist leider bereits vergeben";
            header("Location:errorsite.php");
        }
    }

    //Bauherr hinzufügen
    function createBauherr($conn, $bhName, $bhVorname, $bhNamenzusatz, $bhAdresse, $bhAdresszusatz, $bhPlz, $bhOrt, $bhGender) {
        $conn->query("INSERT INTO bauherr (bh_name, bh_vorname, bh_namenzusatz, bh_adresse, bh_adresszusatz, bh_plz, bh_ort, bh_gender) VALUES ('$bhName', '$bhVorname', '$bhNamenzusatz', '$bhAdresse', '$bhAdresszusatz', '$bhPlz', '$bhOrt', '$bhGender');");
    }

    //Sachbearbeiter hinzufügen
    function createSachbearbeiter($conn, $name, $email, $tel) {
        $conn->query("INSERT INTO sachbearbeiter (sb_name, sb_email, sb_tel) VALUES ('$name', '$email', '$tel');");
    }

    /**********************************************************************************************************************/
    //SELECTS
    /**********************************************************************************************************************/

    //Returniert alle Projekte -> bei Programmstart
    function selectAllProjects($conn)
    {
        if ($result = $conn->query("SELECT projekt.bg_nr_esag, projekt.standortAdresse, projekt.standortOrt, projekt.pv_name, projektart.projektart_bezeichnung, objektart.objektart_bezeichnung, sachbearbeiter.sb_name FROM projekt LEFT JOIN projektart ON projekt.projektart_id=projektart.idProjektart LEFT JOIN objektart ON projekt.objektart_id=objektart.idObjektart LEFT JOIN sachbearbeiter ON projekt.sb_id=sachbearbeiter.idSachbearbeiter;")) {
            $entries = array();
            while ($entry = mysqli_fetch_array($result)) {
                array_push($entries, $entry);
            }
            $result->close();
            return $entries;
        } else {
            $_SESSION['errortext'] = "Die Abfrage konnte nicht korrekt durchgeführt werden";
            header("Location:errorsite.php");
        }
    }

    //Returniert die $anzahl Projekte geordnet nach Eintragung ESAG
    function selectProjects($conn, $anzahl) 
    {
        $entries = array();
        if ($result = $conn->query("SELECT projekt.idProjekt, projekt.bg_nr_esag, projekt.standortAdresse, projekt.standortOrt, projekt.pv_name, projektart.projektart_bezeichnung, objektart.objektart_bezeichnung, sachbearbeiter.sb_name FROM projekt LEFT JOIN projektart ON projekt.projektart_id=projektart.idProjektart LEFT JOIN objektart ON projekt.objektart_id=objektart.idObjektart LEFT JOIN sachbearbeiter ON projekt.sb_id=sachbearbeiter.idSachbearbeiter ORDER BY projekt.bg_eingang DESC, projekt.idProjekt DESC LIMIT $anzahl;")) {
            while ($entry = mysqli_fetch_array($result)) {
                array_push($entries, $entry);
            }
            $result->close();
            return $entries;
        } else {
            $_SESSION['errortext'] = "Die Abfrage konnte nicht korrekt durchgeführt werden";
            header("Location:errorsite.php");
        }
    }

    //liest alle Daten für die Detailansicht des Projektes
    function selectDetailProject($conn, $projectId)
    {
        if ($result = $conn->query("SELECT projekt.bg_nr_esag, projekt.sb_id, projekt.standortAdresse, projekt.standortParzelle, projekt.standortPLZ, projekt.standortOrt, projekt.standortOrtsteil, projekt.bewilligungsbehoerde_id, projekt.bauherr_id, projekt.bh_ansprechperson, projekt.pv_name, projekt.pv_vorname, projekt.pv_namenszusatz, projekt.pv_adresse, projekt.pv_adresszusatz, projekt.pv_plz, projekt.pv_ort, projekt.pv_gender, projekt.pv_ansprechperson, projekt.objektart_id, projekt.projektart_id, projekt.anzahl_we_alt, projekt.anzahl_we_neu, projekt.bgf_alt, projekt.bgf_neu, projekt.bg_eingang, projekt.erschliessung_id, projekt.kosten_id, sachbearbeiter.sb_name, sachbearbeiter.sb_email, sachbearbeiter.sb_tel, bewilligungsbehoerde.bb_name, bewilligungsbehoerde.bb_adresse, bewilligungsbehoerde.bb_plz, bewilligungsbehoerde.bb_ort, bewilligungsbehoerde.bb_bg_nr, bewilligungsbehoerde.bb_bg_dat, bauherr.bh_name, bauherr.bh_vorname, bauherr.bh_namenzusatz, bauherr.bh_adresse, bauherr.bh_adresszusatz, bauherr.bh_plz, bauherr.bh_ort, bauherr.bh_gender, objektart.objektart_bezeichnung, projektart.projektart_bezeichnung, erschliessung.netzanschlusspunkt, erschliessung.rohr_hausanschluss, erschliessung.querschnitt_hausanschlussleitung, erschliessung.absicherung_hak, erschliessung.anschlussleistung, erschliessung.spezielles, erschliessung.bemessungsgroesse, kosten.baukostenbeitraege, kosten.hausanschluss, kosten.anschlussgebueren FROM projekt LEFT JOIN sachbearbeiter ON projekt.sb_id=sachbearbeiter.idSachbearbeiter LEFT JOIN bewilligungsbehoerde ON projekt.bewilligungsbehoerde_id=bewilligungsbehoerde.idBewilligungsbehoerde LEFT JOIN bauherr ON projekt.bauherr_id=bauherr.idBauherr LEFT JOIN objektart ON projekt.objektart_id=objektart.idObjektart LEFT JOIN projektart ON projekt.projektart_id=projektart.idProjektart LEFT JOIN erschliessung ON projekt.erschliessung_id=erschliessung.idErschliessung LEFT JOIN kosten ON projekt.kosten_id=kosten.idKosten WHERE projekt.idProjekt=$projectId;")) {
            $entries = array();
            while ($entry = mysqli_fetch_array($result)) {
                array_push($entries, $entry);
            }
            $result->close();
            return $entries;
        } else {
            $_SESSION['errortext'] = "Die Abfrage konnte nicht korrekt durgeführt werden";
            header("Location:errorsite.php");
        }
    }

    //für die Selektion Bauherr
    function selectBauherr($conn) {
        if($result = $conn->query("SELECT idBauherr, bh_name, bh_vorname FROM bauherr;")) {
            $entries = array();
            while ($entry = mysqli_fetch_array($result)) {
                echo($entry['idBauherr'] . $entry['bh_name']);
                array_push($entries, $entry);
            }
            $result->close();
            return $entries;
        } else {
            $_SESSION['errortext'] = "Die Abfrage konnte nicht korrekt durgeführt werden";
            header("Location:errorsite.php");
        }
    }

    //für die Selektion Behörde
    function selectBehoerde($conn) {
        if($result = $conn->query("SELECT idBewilligungsbehoerde, bb_name FROM bewilligungsbehoerde;")) {
            $entries = array();
            while ($entry = mysqli_fetch_array($result)) {
                array_push($entries, $entry);
            }
            $result->close();
            return $entries;
        } else {
            $_SESSION['errortext'] = "Die Abfrage konnte nicht korrekt durgeführt werden";
            header("Location:errorsite.php");
        }
    }

    //für die Selektion Objektart
    function selectObjektart($conn) {
        if($result = $conn->query("SELECT idObjektart, objektart_bezeichnung FROM objektart;")) {
            $entries = array();
            while ($entry = mysqli_fetch_array($result)) {
                array_push($entries, $entry);
            }
            $result->close();
            return $entries;
        } else {
            $_SESSION['errortext'] = "Die Abfrage konnte nicht korrekt durgeführt werden";
            header("Location:errorsite.php");
        }
    }

    //für die Selektion Projektart
    function selectProjektart($conn) {
        $entries = array();
        if($result = $conn->query("SELECT idProjektart, projektart_bezeichnung FROM projektart;")) {
            while ($entry = mysqli_fetch_array($result)) {
                array_push($entries, $entry);
            }
            $result->close();
            return $entries;
        } else {
            $_SESSION['errortext'] = "Die Abfrage konnte nicht korrekt durgeführt werden";
            header("Location:errorsite.php");
        }
    }

    //für die Selektion Sachbearbeiter
    function selectSachbearbeiter($conn) {
        $entries = array();
        if($result = $conn->query("SELECT idSachbearbeiter, sb_name FROM sachbearbeiter;")) {
            while ($entry = mysqli_fetch_array($result)) {
                array_push($entries, $entry);
            }
            $result->close();
            return $entries;
        } else {
            $_SESSION['errortext'] = "Die Abfrage konnte nicht korrekt durgeführt werden";
            header("Location:errorsite.php");
        }
    }

    /**********************************************************************************************************************/
    //UPDATES
    /**********************************************************************************************************************/

    //Updatet das Projekt mit der zugehörigen Erschliessung
    function updateProjectAfterErschliessung($conn, $projectId, $erschliessungId)
    {
        $conn->query("INSERT INTO projekt (erschliessung_id) VALUES ('$erschliessungId') WHERE idProjekt='$projectId';");   
    }

    /**********************************************************************************************************************/
    //DELETS
    /**********************************************************************************************************************/

    //Ein Projekt enfdgültig Löschen (nur wenn die Verifikation korrekt ist)
    function deleteProject($conn, $projectId, $username, $password)
    {
        if (verifyUser($username, $password)) {

        } else {
            $_SESSION['errortext'] = "Das Projekt konnte nicht gelöscht werden";
            header("Location:errorsite.php");
        }
    }

    /**********************************************************************************************************************/
    //ASSERTS
    /**********************************************************************************************************************/

    //Benutzer verifizieren -> Wenn erfolgreich "true"
    function verifyUser($conn, $username, $password)
    {
        if($result = $conn->query("SELECT pw_hash FROM admin WHERE username = '$username' LIMIT 1;")) {
        $row = mysqli_fetch_array($result);
        if (password_verify($password, $row['pw_hash'])) {
            return true;
        }
        else {
            return false;
        }
    }
    else {
        return false;;
    }
    return false;
    }

    //Überprüft ob der Benutzer $username schon vorhanden ist oder nicht (Wenn vorhanden : True)
    function usernameForgiven($conn, $username) {
        if($result = $conn->query("SELECT username FROM admin WHERE username = '$username';")) {
            $row = mysqli_fetch_array($result);
            if (strcmp($row['name'], $username) != 0) {
                return false;
            }
            else {
                return true;
            }
        }
        else {
            return true;
        }
        return true;
    }
?>