<?php
    session_start();
    $_SESSION['user'] = 'musicpass';
    $_SESSION['pass'] = 'UqnTy9qK72qiMen1';

    global $bdd;
    $bdd = new PDO('mysql:host=localhost;dbname=musicpass;charset=utf8', "{$_SESSION['user']}", "{$_SESSION['pass']}");
?>