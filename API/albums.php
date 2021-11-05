<?php

include ("../connexion_base.php");
$request_method = $_SERVER["REQUEST_METHOD"];

$headers = apache_request_headers();

switch($request_method){
    case 'GET':
        //TODO : éviter les conditions multiples et préférer un paramètre "action" et un switch
        if (isset($_GET['count'])){
            countAlbums();
        }else if (isset($_GET['groupe'])){
            getAlbum(0, -1, null, $_GET['groupe']);
        }else if (isset($_GET['search'])){
            getAlbum(0, -1, $_GET['search']);
        }else if (!empty($_GET["album"])){
            getAlbum($_GET["album"]);
        }else{
            if (!empty($_GET["page"])){
                getAlbum(0, $_GET["page"]);
            }else{
                getAlbum();
            }
        }
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

function countAlbums(){
    global $bdd;
    $result = $bdd->query("SELECT COUNT(*) FROM albums");
    //TODO : il n'y a qu'une seule réponse, fetch aurait suffit
    $reponse = $result->fetchAll(PDO::FETCH_COLUMN);
    //TODO : les deux lignes suivantes sont affichés dans plusieurs fonctions, il y a donc moyen de les factoriser
    header('Content-Type: application/json');
    echo json_encode($reponse[0], JSON_PRETTY_PRINT);
}

function getAlbum($id = "0", $page = "-1", $search = null, $groupe = 0){
    global $bdd;
    //TODO : limiter la requête dans tous les cas
    $query = "SELECT * FROM albums";
    $reponse = array();

    if ($groupe != 0){
        $query .= " WHERE artiste={$groupe}";
    }else if ($search != null){
        $query .= " WHERE nom LIKE '{$search}%'";
    }else if ($id != "0"){
        $query .= " WHERE id='{$id}' LIMIT 1";
    }

    if ($page != "-1"){
        $pageCalc = 5 * ($page - 1);
        $query .= " LIMIT 5";
        if ($pageCalc > 0){
            $query .= ",{$pageCalc}";
        }
    }

    $result = $bdd->query($query);
    $albums = $result->fetchAll(PDO::FETCH_ASSOC);

    //TODO : faire une seule requete avec une jointure dans la fonction au lieu de faire une boucle
    foreach ($albums as $album){
        $groupeResult = $bdd->query("SELECT nom FROM groupes WHERE id={$album['artiste']}");
        $artiste = $groupeResult->fetchAll();

        $album['artiste'] = $artiste[0]['nom'];
        $reponse[] = $album;
    }

    header('Content-Type: application/json');
    echo json_encode($reponse, JSON_PRETTY_PRINT);
}