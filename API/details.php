<?php

include ("../connexion_base.php");
$request_method = $_SERVER["REQUEST_METHOD"];

switch($request_method){
    case 'GET':
        if (!empty($_GET["album"])){
            echo $_GET["album"];
        }else{
            echo "tout tout tout";
        }
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
}