<?php
include("../connexion_base.php");
$request_method = $_SERVER["REQUEST_METHOD"];
header('Content-Type: application/json');
switch ($request_method) {
    case 'GET':
        if (isset($_GET['table'])){
            getAlbum($_GET['table']);
        }
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

function getAlbum($structure)
{
    global $bdd;

    $columns = $bdd->query("SHOW COLUMNS FROM {$structure}")->fetchAll(PDO::FETCH_ASSOC);
    $reponse = array();

    foreach ($columns as $column){
        $reponse[] = $column['Field'];
    }

    echo json_encode($reponse, JSON_PRETTY_PRINT);
}