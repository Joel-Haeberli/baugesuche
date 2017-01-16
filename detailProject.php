<!DOCTYPE html>
<html>
<head>
    <?php

        //Diese Seite stellt die Detailseite für ein beliebiges Projekt dynamisch anhand der erhaltenen Projekt her.

        session_start();
        include"db_actions.php";
        $conn = getConn();

        $projectId = $_POST["projectId"];

        $wholeProject = selectDetailProject($conn, $projectId);
    ?>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="design_all.css">
    <link rel="stylesheet" href="design_detailProject.css">
</head>
<body>
    <div id="navigation">
       <?php
           include"loadNavigation.php";
       ?>
    </div>
    <div id="loginSpace">
        <div id="left">
            <?php
                echo("<p>Details vom Projekt " . $projectId . "</p>");
                echo("<p>Whole Project: " . implode("",$wholeProject[0]) . "</p>");
                foreach($wholeProject as $project) {
                    echo("<div class='datagroup'><p>BG-Nummer:" .$project['bg_nr_esag']. "</p>");
                    echo("<p>BG-Eingang-ESAG:" .$project['bg_eingang']. "</p></div>");
                    echo("<div class='datagroup'><p>Sachbearbeiter:" .$project['sb_name']. "</p>");
                    echo("<p>Sachbearbeiter-Email:" .$project['sb_email']. "</p>");
                    echo("<p>Sachbearbeiter-tel:" .$project['sb_tel']. "</p></div>");
                    echo("<div class='datagroup'><p>Projekt Adresse:" .$project['standortAdresse']. "</p>");
                    echo("<p>Projekt Parzelle:" .$project['standortParzelle']. "</p>");
                    echo("<p>Projekt PLZ:" .$project['standortPLZ']. "</p>");
                    echo("<p>Projekt Ort:" .$project['standortOrt']. "</p>");
                    echo("<p>Projekt Ortsteil:" .$project['standortOrtsteil']. "</p></div>");
                    echo("<div class='datagroup'><p>Bewilligungsbehörde Name:" .$project['bb_name']. "</p>");
                    echo("<p>Bewilligungsbehörde Adresse:" .$project['bb_adresse']. "</p>");
                    echo("<p>Bewilligungsbehörde PLZ:" .$project['bb_plz']. "</p>");
                    echo("<p>Bewilligungsbehörde Ort:" .$project['bb_ort']. "</p>");
                    echo("<p>Bewilligungsbehörde BG-Nummer:" .$project['bb_bg_nr']. "</p>");
                    echo("<p>Bewilligungsbehörde BG-Eingang:" .$project['bb_bg_dat']. "</p></div>");
                    echo("<div class='datagroup'><p>Bauherr Name:" .$project['bh_name']. "</p>");
                    echo("<p>Bauherr Vorname:" .$project['bh_vorname']. "</p>");
                    echo("<p>Bauherr Namenszusatz:" .$project['bh_namenzusatz']. "</p>");
                    echo("<p>Bauherr Adresse:" .$project['bh_adresse']. "</p>");
                    echo("<p>Bauherr Adresszusatz:" .$project['bh_adresszusatz']. "</p>");
                    echo("<p>Bauherr PLZ:" .$project['bh_plz']. "</p>");
                    echo("<p>Bauherr Ort:" .$project['bh_ort']. "</p>");
                    echo("<p>Bauherr Gender:" .$project['bh_gender']. "</p>");
                    echo("<p>Bauherr Ansprechperson:" .$project['bh_ansprechperson']. "</p></div>");
                    echo("<div class='datagroup'><p>Projektverfasser Name:" .$project['pv_name']. "</p>");
                    echo("<p>Projektverfasser Vorname:" .$project['pv_vorname']. "</p>");
                    echo("<p>Projektverfasser Namenszusatz:" .$project['pv_namenszusatz']. "</p>");
                    echo("<p>Projektverfasser Adresse:" .$project['pv_adresse']. "</p>");
                    echo("<p>Projektverfasser Adresszusatz:" .$project['pv_adresszusatz']. "</p>");
                    echo("<p>Projektverfasser PLZ:" .$project['pv_plz']. "</p>");
                    echo("<p>Projektverfasser Ort:" .$project['pv_ort']. "</p>");
                    echo("<p>Projektverfasser Gender:" .$project['pv_gender']. "</p>");
                    echo("<p>Projektverfasser Ansprechperson:" .$project['pv_ansprechperson']. "</p></div>");
                    echo("<div class='datagroup'><p>Objektart:" .$project['objektart_bezeichnung ']. "</p></div>");
                    echo("<div class='datagroup'><p>Projektart:" .$project['projektart_bezeichnung']. "</p><div>");
                    echo("<div class='datagroup'><p>Netzanschluss:" .$project['netzanschluss']. "</p>");
                    echo("<p>Rohr Hausanschluss:" .$project['rohr_hausanschluss']. "</p>");
                    echo("<p>Querschnitt Hausanschlussleitung:" .$project['hausanschlussleitung']. "</p>");
                    echo("<p>Absicherung HAK:" .$project['absicherung_hak']. "</p>");
                    echo("<p>Anschlussleistung:" .$project['anschlussleistung']. "</p>");
                    echo("<p>Spezielles:" .$project['spezielles']. "</p>");
                    echo("<p>Bemessungsgrösse:" .$project['bemessungsgroesse']. "</p></div>");
                    echo("<div class='datagroup'><p>Baukostenbeiträge:" .$project['baukostenbeitraege']. "</p>");
                    echo("<p>Hausanschluss:" .$project['hausanschluss']. "</p>");
                    echo("<p>Anschlussgebühren:" .$project['anschlussgebueren']. "</p></div>");
                    echo("<div class='datagroup'><p>Anzahl WE alt:" .$project['anzahl_we_alt']. "</p>");
                    echo("<p>Anzahl WE neu:" .$project['anzahl_we_neu']. "</p>");
                    echo("<p>BGF alt:" .$project['bgf_alt']. "</p>");
                    echo("<p>BGF neu:" .$project['bgf_neu']. "</p></div>");
                }
            ?>
        </div>
        <div id="right">
            <?php
                if (!($_SESSION['username'] == "gast")) {
                echo ("<form method='POST' action='editProject.php'>
                            <input type='hidden' name='projectId' value='" . $projectId . "'>
                            <input type='submit' class='button' value='Projekt bearbeiten'>
                        </form><br>
                        <form method='POST' action='addProperty.php'>
                            <input type='hidden' name='projectId' value='" . $projectId . "'>
                            <input type='hidden' name='whichDocument' value='erschliessung'>
                            <input type='submit' class='button' value='Erschliessung eintragen'>
                        </form><br>
                        <form method='POST' action='addProperty.php'>
                            <input type='hidden' name='projectId' value='" . $projectId . "'>
                            <input type='hidden' name='whichDocument' value='kosten'>
                            <input type='submit' class='button' value='Kosten eintragen'>
                        </form><br>");
                } 
            ?>
            <form method='POST' action='createDocument.php'>
                <input type='hidden' name='projectId' value='[ID]'>
                <input type='hidden' name='whichDocument' value='[WHICH]'>
                <input type='submit' class='button' value='Dokument 01 kreieren'>
            </form><br>
            <form method='POST' action='createDocument.php'>
                <input type='hidden' name='projectId' value='[ID]'>
                <input type='hidden' name='whichDocument' value='[WHICH]'>
                <input type='submit' class='button' value='Dokument 02 kreieren'>
            </form><br>
        </div>
    </div>
</body>
</html>