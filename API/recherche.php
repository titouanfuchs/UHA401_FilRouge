<?php

include("../connexion_base.php");
$request_method = $_SERVER["REQUEST_METHOD"];

$headers = apache_request_headers();

switch ($request_method) {
    case 'GET':
        if (isset($_GET["search"])) {
            getResearch($_GET["search"], 1);
        }
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

function getAlbumSearch($arg){
    header('Content-Type: application/json');

    global $bdd;

    $reponse = array("groupes" => array(), "albums"=>array());
    $foundSomthing = false;

    $result = $bdd->query("SELECT * FROM albums WHERE nom LIKE '{$arg}%'");
    $albums = $result->fetchAll(PDO::FETCH_ASSOC);

    foreach ($albums as $album){
        $reponse["albums"][] = $album;

        $groupeReponse = $bdd->query("SELECT * FROM groupes WHERE id='{$album['artiste']}'");
        $groupes = $groupeReponse->fetchAll(PDO::FETCH_ASSOC);

        $reponse["groupes"][] = $groupes[0];

        $foundSomthing = true;
    }

    return $reponse;
}

function getGroupSearch($arg){
    header('Content-Type: application/json');
    global $bdd;

    $reponse = array();
    $foundSomthing = false;

    $result = $bdd->query("SELECT * FROM groupes WHERE nom LIKE '{$arg}%'");
    $groupes = $result->fetchAll(PDO::FETCH_ASSOC);

    foreach ($groupes as $group){
        $reponse[] = $group;
        $foundSomthing = true;
    }

    return $reponse;
}

function getResearch($arg, $page)
{
    global $bdd;

    $reponse = array("albums" => array(), "groupes" => array());

    $groupes = getGroupSearch($arg);

    foreach ($groupes as $groupe){
        $reponse['groupes'][] = $groupe;
    }

    $albumResearch = getAlbumSearch($arg);

    foreach ($albumResearch['groupes'] as $groupe){
        if (!in_array($groupe, $reponse['groupes'])){
            $reponse['groupes'][] = $groupe;
        }
    }

    foreach ($albumResearch['albums'] as $album){
        $reponse['albums'][] = $album;
    }

    /*if ($page != "-1") {
        $pageCalc = 5 * ($page - 1);
        $query .= " LIMIT 5";
        if ($pageCalc > 0) {
            $query .= ",{$pageCalc}";
        }
    }*/

    header('Content-Type: application/json');
    echo json_encode($reponse, JSON_PRETTY_PRINT);
}