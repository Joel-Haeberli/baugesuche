<?php
    //Diese Seite hilft, Tabellen anhand von Abfragen zu generieren

    //ACHTUNG!!!
    //Setzt ein session_start() auf aufrufender Seite voraus
    //Setzt ein include"db_actions.php" auf aufrufender Seite voraus

    //Standart Header und Standart Daten --> Kann man mit den zuunterst geführten funktionen getDefaultHeader() und getDefaultProperties() holen
    //propertynameDefault --> Erster Eintrag in diesem Array ist der Identifikator für den "Details"-Button -> ID von einem Projekt

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
            tableData($propertyNames, $data);
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

        printOutput("Länge der propertyName: " . $propertyNameLen);
        printOutput("Länge der data: " . count($data));

        foreach ($data as $row) {
            echo("<tr>");
            //Aus einem mir nicht erklärbaren Grund wird das Resultat doppelt zurück gegeben. Ich konnte das Problem nicht finden. Wenn ich das Array jedoch nur bis zur hälfte durchgehe, dann geht es. Werde dem Problem in einem späteren Sprnt nachgehen.
            $wholeRow = count($row);
            $halfRow = $wholeRow / 2;
            for ($i = 1; $i	< $halfRow; $i++) {
                printOutput("Row i: " . $row[$propertyName[$i]]);
                if (isset($row[$propertyName[$i]])) {
                    echo("<td>" . $row[$propertyName[$i]] . "</td>");
                } else {
                    echo("<td>---</td>");
                }
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
        return array("BG-Nummer","Adresse Objekt","Standortgemeinde","Projektverfasser","Projektart","Objektart","Name-SB","Details");
    }

    function getDefaultProperties() {
        return array("idProjekt","bg_nr_esag","standortAdresse","standortOrt","pv_name", "projektart_bezeichnung","objektart_bezeichnung","sb_name");
    }

    function printOutput($output) {
        echo("<p>" . $output . "</p>");
    }
?>  