<!DOCTYPE html>
<html>
  <head>
    <?php
        //Diese Datei ist die Startseite der Applikation
        //Erstellt am: 03.02.2016
        session_start();

        if (!(isset($_SESSION['username']))) {
          $_SESSION['username'] = "gast";
        }

        include"db_actions.php";

        $conn = getConn();

        include"tableGenerator.php";
    ?>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="design_all.css">
    <link rel="stylesheet" href="design_index.css">
  </head>
  <body>
    <div id="navigation">
       <?php
           include"loadNavigation.php";
       ?>
    </div>
    <div id="suche">
      <form method="POST" action="search.php">
        <div id="search_left">
          <input type="radio" name="afterwhat" value="1">BG-Nummer<br>
          <input type="radio" name="afterwhat" value="2">Adresse Objekt<br>
          <input type="radio" name="afterwhat" value="3">Standortgemeinde<br>
          <input type="radio" name="afterwhat" value="4">Projektverfasser<br>
          <input type="radio" name="afterwhat" value="5">Projektart<br>
          <input type="radio" name="afterwhat" value="6">Objektart<br>
          <input type="radio" name="afterwhat" value="7">Name-SB<br>
        </div>
        <div id="search_right">
          <input type="textbox" name="filter" placeholder="filtern nach..." class="input"><br><br>
          <input type="textbox" name="sortierer" placeholder="sortieren nach..." class="input"><br><br>
          <input type="submit" value="Suchen" class="button">
        </div>
      </form>
    </div>
    <div id="daten">
      <?php
        indexTable($conn, getDefaultHeader(), getDefaultProperties());
      ?>
    </div>
    <footer>
      <p>Designed and developed by Joel Häberli</p>
    </footer>
  </body>
</html>