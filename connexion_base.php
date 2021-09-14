<?php
    session_start();
    $_SESSION['bdd'] = new PDO('mysql:host=localhost;dbname=musicpass;charset=utf8', 'root', 'root');
?>