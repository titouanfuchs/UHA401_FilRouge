<?php
    session_start();
    $_SESSION['user'] = 'root';
    $_SESSION['pass'] = '';

    global $bdd;
    $bdd = new PDO('mysql:host=localhost;dbname=musicpass;charset=utf8', "{$_SESSION['user']}", "{$_SESSION['pass']}");
?>