<?php

include("../connexion_base.php");
$request_method = $_SERVER["REQUEST_METHOD"];

$headers = apache_request_headers();

switch ($request_method) {
    case 'GET':
        if (isset($_GET["search"])) {
            getResearch($_GET["search"]);
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

    $result = $bdd->query("SELECT * FROM albums WHERE nom LIKE '{$arg}%'");
    $albums = $result->fetchAll(PDO::FETCH_ASSOC);

    foreach ($albums as $album){
        $groupeReponse = $bdd->query("SELECT * FROM groupes WHERE id='{$album['artiste']}'");
        $groupes = $groupeReponse->fetchAll(PDO::FETCH_ASSOC);

        $album["artiste"] = $groupes[0]["nom"];

        $reponse["groupes"][] = $groupes[0];

        $reponse["albums"][] = $album;
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
        $genreResultID = $bdd->query("SELECT genre FROM link_groupe_genre WHERE groupe={$group['id']}");
        $genresID = $genreResultID->fetchAll(PDO::FETCH_ASSOC);

        $groupGenre = array();

        foreach ($genresID as $ID){
            $genreR_ = $bdd->query("SELECT nom FROM genres WHERE id={$ID['genre']}"); //va disparaître
            $genres = $genreR_->fetchAll(PDO::FETCH_ASSOC);

            foreach ($genres as $genre){
                array_push($groupGenre, $genre);
            }
        }

        $group['genres'] = $groupGenre;


        $reponse[] = $group;
        $foundSomthing = true;
    }

    return $reponse;
}

function getResearch($arg)
{
    global $bdd;

    $result = array("albums" => array(), "groupes" => array());

    $groupes = getGroupSearch($arg);

    foreach ($groupes as $groupe){
        $result['groupes'][] = $groupe;
    }

    $albumResearch = getAlbumSearch($arg);

    foreach ($albumResearch['groupes'] as $groupe){
        $genreResultID = $bdd->query("SELECT genre FROM link_groupe_genre WHERE groupe={$groupe['id']}");
        $genresID = $genreResultID->fetchAll(PDO::FETCH_ASSOC);

        $groupGenre = array();

        foreach ($genresID as $ID){
            $genreR_ = $bdd->query("SELECT nom FROM genres WHERE id={$ID['genre']}");
            $genres = $genreR_->fetchAll(PDO::FETCH_ASSOC);

            foreach ($genres as $genre){
                array_push($groupGenre, $genre);
            }
        }

        $groupe['genres'] = $groupGenre;

        if (!in_array($groupe, $result['groupes'])){
            $result['groupes'][] = $groupe;
        }
    }

    foreach ($albumResearch['albums'] as $album){
        $result['albums'][] = $album;
    }

    header('Content-Type: application/json');
    echo json_encode($result, JSON_PRETTY_PRINT);
}