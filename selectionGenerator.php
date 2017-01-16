<?php
    //Diese Seite generiert mithilfe der funktionen Dropdowns für die Eingabemasken

    function selectionBauherr($conn) {
        echo("<select name='sbauherr' class='selection'>
                <option value='-1'>Bauherr wählen</option>");
        
        $entries = selectBauherr($conn);
        foreach ($entries as $entry) {
            $id = $entry['idBauherr'];
            $name = $entry['bh_name'] . " " . $entry['bh_vorname'];

            echo($id . $name);

            echo("<option value=" . $id . ">" . $name . "</option>");
        }

        echo("</select>");
    }

    function selectionBehoerde($conn) {
        echo("<select name='sbehoerde' class='selection'>
                <option value='-1'>Behörde wählen</option>");
        
        $entries = selectBehoerde($conn);
        foreach ($entries as $entry) {
            $id = $entry['idBehoerde'];
            $name = $entry['bb_name'];

            echo("<option value=" . $id . ">" . $name . "</option>");
        }

        echo("</select>");
    }

    function selectionObjektart($conn) {
        echo("<select name='sObjektart' class='selection'>
                <option value='-1'>Objektart wählen</option>");
        
        $entries = selectObjektart($conn);
        foreach ($entries as $entry) {
            $id = $entry['idObjektart'];
            $name = $entry['objektart_bezeichnung'];

            echo("<option value=" . $id . ">" . $name . "</option>");
        }

        echo("</select>");
    }

    function selectionProjektart($conn) {
        echo("<select name='sProjektart' class='selection'>
                <option value='-1'>Projektart wählen</option>");
        
        $entries = selectProjektart($conn);
        foreach ($entries as $entry) {
            $id = $entry['idProjektart'];
            $name = $entry['projektart_bezeichnung'];

            echo("<option value=" . $id . ">" . $name . "</option>");
        }

        echo("</select>");
    }

    function selectionSachbearbeiter($conn) {
        echo("<select name='sSachbearbeiter' class='selection'>
                <option value='-1'>Sachbearbeiter wählen</option>");
        
        $entries = selectSachbearbeiter($conn);
        foreach ($entries as $entry) {
            $id = $entry['idSachbearbeiter'];
            $name = $entry['sb_name'];

            echo("<option value=" . $id . ">" . $name . "</option>");
        }

        echo("</select>");
    }
?>