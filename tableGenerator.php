<?php
    //Diese Seite hilft, Tabellen anhand von Abfragen zu generieren

    //ACHTUNG!!!
    //Setzt ein session_start() auf aufrufender Seite voraus
    //Setzt ein include"db_actions.php" auf aufrufender Seite voraus

    //Standart Header und Standart Daten --> Kann man mit den zuunterst geführten funktionen getDefaultHeader() und getDefaultProperties() holen
    $headerDefault = array("BG-Nummer","Adresse Objekt","Standortgemeinde","Projektverfasser","Projektart","Objektart","Name-SB","Details");
    //Erster Eintrag in diesem Array ist der Identifikator für den "Details"-Button -> ID von einem Projekt
    $propertynameDefault = array("idProjekt","bg_nr_esag","standortAdresse","standortOrt","pv_name","objektart_bezeichnung","sb_name");

    function indexTable($conn, $headers, $propertyNames) {
        $data = selectAllProjects($conn);
        table($headers, $propertyNames, $data);
    }

    function filterTable($conn, $filter) {

    }

    function sortTable($conn, $sort) {

    }

    function table($headers, $propertyNames,$data) {
        echo("<table>");
            tableHeader($headers);
            tableData($propertynameDefault, $data);
        echo("</table>");
    }

    function tableHeader($columnTitles) {
        echo("<thead>");
        foreach ($columnTitles as $columnTitle) {
            echo("<th>" . $columnTitle . "</th>");
        }
        echo("</thead>");
    }

    function tableData($propertyName, $data) {
        echo("<tbody>");

        $propertyNameLen = count($propertyName);

        foreach ($row as $data) {
            echo("<tr>");
            for ($i = 1; $i	< count($row); $i++) {
                echo("<td>" . $row[$propertyName[$i]] . "</td>");
            }
            echo("<td>
            <form method='POST' action='detailProject.php'>
                <input type='hidden' name='projectId' value=" . $row[$propertyName[0]] . ">
                    <button type='submit' class='button'>Detail</button>
                </form>
            </td></tr>");
        }

        echo("</tbody>");
    }

    function getDefaultHeader() {
        return $headerDefault;
    }

    function getDefaultProperties() {
        return $propertynameDefault;
    }
?>  