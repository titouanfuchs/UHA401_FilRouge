<?php

include ("connexion_base.php");
header('Content-Type: application/json');
global $actionReponse;
$actionReponse = array();

if (isset($_GET['action'])){
    switch ($_GET['action']){
        case "clear":
            clearDB();
            break;
        case "build":
            buildBD();
            break;
        case "fill":
            fillBD();
            break;
        case "total":
        default:
            total();
            break;
    }
}else{
    total();
}

function buildBD($total = false){
    global $bdd;
    global $actionReponse;

    try{
        $bdd->query("SET FOREIGN_KEY_CHECKS = 0;");
        $bdd->query("DROP TABLE IF EXISTS details");
        $bdd->query("DROP TABLE IF EXISTS albums");
        $bdd->query("DROP TABLE IF EXISTS groupes");
        $bdd->query("DROP TABLE IF EXISTS link_groupe_genre");
        $bdd->query("DROP TABLE IF EXISTS tracks");
        $bdd->query("DROP TABLE IF EXISTS genres");
        $bdd->query("SET FOREIGN_KEY_CHECKS = 1;");

        $sql = file_get_contents('./sql/api_music.sql');
        $bdd->query($sql);
        $actionReponse['dbBuild'] = 'OK';
    }catch (Exception $e){
        $actionReponse['dbBuild'] = $e;
    }

    if (!$total){
        echo json_encode($actionReponse, JSON_PRETTY_PRINT);
    }
}

function clearDB($total = false){
    global $bdd;
    global $actionReponse;

    try{
        $bdd->query("SET FOREIGN_KEY_CHECKS = 0;");
        $bdd->query("TRUNCATE details");
        $bdd->query("TRUNCATE albums");
        $bdd->query("TRUNCATE groupes");
        $bdd->query("TRUNCATE link_groupe_genre");
        $bdd->query("TRUNCATE genres");
        $bdd->query("SET FOREIGN_KEY_CHECKS = 1;");
        $actionReponse['dbClear'] = 'OK';
    }catch (Exception $e){
        $actionReponse['dbClear'] = $e;
    }

    if (!$total){
        echo json_encode($actionReponse, JSON_PRETTY_PRINT);
    }
}

function fillBD($total = false){
    global $bdd;
    global $actionReponse;

    try{
        //$albums_data = @file_get_contents('https://filrouge.uha4point0.fr/music/albums');
        $albums_data = @file_get_contents('./apiLocal/albums.json');
        $albums = json_decode($albums_data,true);

        //$groupes_data = @file_get_contents('https://filrouge.uha4point0.fr/music/groupes');
        $groupes_data = @file_get_contents('./apiLocal/groupes.json');
        $groupes = json_decode($groupes_data,true);

        foreach ($groupes as $groupe){
            foreach ($groupe['genre'] as $genre){
                $reponse = $bdd->query("SELECT * FROM genres WHERE nom='{$genre}'");
                $genreResult = $reponse->fetchAll();

                if (count($genreResult) == 0){
                    pushGenreToBDD($genre);
                }

                $genreid = array();

                $reponse = $bdd->query("SELECT id FROM genres WHERE nom='{$genre}'");
                $genreResult = $reponse->fetchAll();

                foreach ($genreResult as $id){
                    array_push($genreid, $id['id']);
                }

                $reponse = $bdd->query("SELECT * FROM groupes WHERE nom='{$groupe['nom']}'");
                $groupeResult = $reponse->fetchAll();

                if (count($groupeResult) == 0){
                    pushGroupToBDD($groupe);
                }

                foreach ($genreid as $genre_){
                    linkGroupToGenre($groupe['id'], $genre_);
                }
            }
        }

        foreach ($albums as $album) {
            $reponse = $bdd->query("SELECT * FROM groupes WHERE id='{$album['artiste']}'");
            $groupReponse = $reponse->fetchAll();

            if (count($groupReponse) != 0) {
                pushAlbumToBDD($album);
            }
        }
        $actionReponse['dbFill'] = "OK";
    }catch (Exception $e){
        $actionReponse['dbFill'] = $e;
    }

    if (!$total){
        echo json_encode($actionReponse, JSON_PRETTY_PRINT);
    }
}

function linkGroupToGenre($groupid,$genreid){
    global $bdd;
    $req = $bdd->prepare('INSERT INTO link_groupe_genre(groupe, genre) VALUES(:groupe, :genre)');
    $req->execute(array(
        'groupe' => $groupid,
        'genre' => $genreid
    )) or die(print_r($req->errorInfo()));
}

function pushGenreToBDD($genre){ //Remplissage des genres;
    global $bdd;
    $req = $bdd->prepare('INSERT INTO genres(nom) VALUES(:nom)');
    $req->execute(array(
        'nom' => $genre
    )) or die(print_r($req->errorInfo()));
}

function pushGroupToBDD($group){
    global $bdd;

    $req = $bdd->prepare('INSERT INTO groupes(nom, chanteur, origin) VALUES(:nom, :chanteur, :origin)');
    $req->execute(array(
        'nom' => $group['nom'],
        'chanteur' => $group['chanteur'],
        'origin' => $group['origin']
    )) or die(print_r($req->errorInfo()));
}

function pushAlbumToBDD($album){
    global $bdd;

    $req = $bdd->prepare('INSERT INTO albums(nom, artiste, pistes, sortie, couverture) VALUES(:nom, :artiste, :pistes, :sortie, :couverture)');
    $req->execute(array(
        'nom' => $album['nom'],
        'artiste' => $album['artiste'],
        'pistes' => $album['pistes'],
        'sortie' => $album['sortie'],
        'couverture' => $album['couverture']
    )) or die(print_r($req->errorInfo()));
}

function total(){
    global $actionReponse;
    buildBD(true);
    clearDB(true);
    fillBD(true);

    echo json_encode($actionReponse, JSON_PRETTY_PRINT);
}