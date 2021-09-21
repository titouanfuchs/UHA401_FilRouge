<?php
    session_start();
    $_SESSION['user'] = 'root';
    $_SESSION['pass'] = '';

    $_SESSION['APIPASS'] = 'Parcequejailedroit';

    global $bdd;
    $bdd = new PDO('mysql:host=localhost;dbname=musicpass;charset=utf8', "{$_SESSION['user']}", "{$_SESSION['pass']}");
    global $sqli_bdd;
    $sqli_bdd = mysqli_connect("localhost", $_SESSION['user'], $_SESSION['pass'], "musicpass");

    $_SESSION['AlbumPage'] = 0;
    $_SESSION['GroupPage'] = 0;
?>