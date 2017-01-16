<!DOCTYPE html>
<html>
    <head>
        <!-- Diese Seite soll beliebige Fehlermeldungen anzeigen, welche von der aufrufenden Seite in der Session-Variable "errortext" gespeichert wurde -->
        <meta charset='utf-8'/>
        <link rel='stylesheet' href='design_all.css'>
        <link rel='stylesheet' href='design_errorsite.css'>
    </head>
    <body>
        <div id="navigation">
            <?php
                session_start();
                include"loadNavigation.php"
            ?>
        </div>
        <div id='errortext'>
            <?php
                $error = "<p>Es ist ein Fehler aufgetreten. Falls beim selben Schritt/Vorgang wieder Fehler auftauchen, melden Sie es bitte.</p><p>Vielen Dank</p>";
                if (isset($_SESSION['errortext'])) {
                    $error = $_SESSION['errortext'];
                }
                echo("<p>" . $error . "</p>");
                $_SESSION['errortext'] = "";
            ?>
        </div>
        <footer>
            <p>Designed and developed by Joel Häberli</p>
        </footer>
    </body>
</html>