<?php
    session_start();
    $_SESSION['user'] = 'local';
    $_SESSION['pass'] = 'Ms1570lety_';

    $_SESSION['APIPASS'] = 'Parcequejailedroit';
    global $bdd;
    $mySql = new PDO('mysql:host=localhost;charset=utf8', "{$_SESSION['user']}", "{$_SESSION['pass']}");

    $mySql->query("CREATE DATABASE IF NOT EXISTS api_music;");

    $bdd = new PDO('mysql:host=localhost;dbname=api_music;charset=utf8', "{$_SESSION['user']}", "{$_SESSION['pass']}");
    global $sqli_bdd;
    $sqli_bdd = mysqli_connect("localhost", $_SESSION['user'], $_SESSION['pass'], "api_music");

    $_SESSION['detailsStruct'] = ['id', 'album', 'lastfm', 'description', 'tracks'];
?>