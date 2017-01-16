<?php
    //Login für die Administratoren
    include"db_actions.php";
    session_start();

    $conn = getConn();

    $username = $_POST['benutzername'];
    $password = $_POST['passwort'];

    if (verifyUser($conn, $username, $password)) {
        $_SESSION['username'] = $username;
    }

    header("Location:index.php");
?>