<?php
    session_start();
    $_SESSION['user'] = 'root';
    $_SESSION['pass'] = '12345678';

    $_SESSION['APIPASS'] = 'Parcequejailedroit';
    global $bdd; //TODO global est inutile, tu n'es pas à l'intérieur d'une fonction
    $mySql = new PDO('mysql:host=localhost;charset=utf8', "{$_SESSION['user']}", "{$_SESSION['pass']}");

    $mySql->query("CREATE DATABASE IF NOT EXISTS api_music;");
    //TODO : pourquoi se reconnecter à la base de donnée ? (il existe une requête USE pour utiliser une BDD)
    $bdd = new PDO('mysql:host=localhost;dbname=api_music;charset=utf8', "{$_SESSION['user']}", "{$_SESSION['pass']}");
    global $sqli_bdd;
    //TODO : trois connexions avec deux systèmes différents, c'est un peu trop
    $sqli_bdd = mysqli_connect("localhost", $_SESSION['user'], $_SESSION['pass'], "api_music");

    $_SESSION['detailsStruct'] = ['id', 'album', 'lastfm', 'description', 'tracks'];
?>