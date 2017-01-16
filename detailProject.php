<?php

    //Diese Seite stellt die Detailseite für ein beliebiges Projekt dynamisch anhand der erhaltenen Projekt her.

    session_start();
    include"db_actions.php";
    $conn = getConn();

    $projectId = $_POST["projectId"];

    echo("<p>Details vom Projekt " . $projectId . "</p>");

    $wholeProject = selectDetailProject($conn, $projectId);

    echo("<p>Whole Project: " . implode("",$wholeProject[0]) . "</p>");

?>