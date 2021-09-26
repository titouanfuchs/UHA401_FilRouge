<?php

include ("../connexion_base.php");
$request_method = $_SERVER["REQUEST_METHOD"];

$headers = apache_request_headers();

switch($request_method){
    case 'GET':
        if (!empty($_GET["groupe"])){
            getGroup($_GET["groupe"]);
        }else{
            getGroup();
        }
        break;
    case 'POST':
        if ($headers['Authorization'] == $_SESSION['APIPASS']) {
            postAlbum();
        }else{
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');

            echo "Accès non autorisé !";
        }
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

function getGroup($id = "0"){
    global $bdd;
    $query = "SELECT * FROM groupes";
    $reponse = array();

    if ($id != "0"){
        $query .= " WHERE id='{$id}' LIMIT 1";
    }

    $result = $bdd->query($query);
    $groups = $result->fetchAll(PDO::FETCH_ASSOC);

    foreach ($groups as $group){
        $genreResultID = $bdd->query("SELECT genre FROM link_groupe_genre WHERE groupe={$group['id']}");
        $genresID = $genreResultID->fetchAll(PDO::FETCH_ASSOC);

        $groupGenre = array();

        foreach ($genresID as $ID){
            $genreR_ = $bdd->query("SELECT nom FROM genres WHERE id={$ID['genre']}");
            $genres = $genreR_->fetchAll(PDO::FETCH_ASSOC);

            foreach ($genres as $genre){
                array_push($groupGenre, $genre);
            }
        }

        $group['genres'] = $groupGenre;

        $reponse[] = $group;
    }

    header('Content-Type: application/json');
    echo json_encode($reponse, JSON_PRETTY_PRINT);
}