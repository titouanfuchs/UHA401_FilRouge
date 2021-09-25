<?php

require ("connexion_base.php");

if (isset($_GET['action'])){
    switch ($_GET['action']){
        case "clear":
            clearDB();
            redirect();
            break;
        case "build":
            buildBD();
            redirect();
            break;
        case "fill":
            fillBD();
            redirect();
            break;
        default:
            total();
            break;
    }
}else{
    total();
}

function buildBD(){
    global $bdd;

    $sql = file_get_contents('sql/api_music.sql');

    $bdd->query($sql);
}

function clearDB(){
    global $bdd;

    $bdd->query("SET FOREIGN_KEY_CHECKS = 0;");
    $bdd->query("TRUNCATE genres");
    $bdd->query("TRUNCATE details");
    $bdd->query("TRUNCATE albums");
    $bdd->query("TRUNCATE groupes");
    $bdd->query("TRUNCATE link_groupe_genre");
    $bdd->query("SET FOREIGN_KEY_CHECKS = 1;");
}

function fillBD(){
    global $bdd;

    $albums_data = file_get_contents('https://filrouge.uha4point0.fr/music/albums');
    $albums =json_decode($albums_data,true);

    $groupes_data = file_get_contents('https://filrouge.uha4point0.fr/music/groupes');
    $groupes =json_decode($groupes_data,true);


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

function redirect(){
    header('Location: ./');
}

function total(){
    buildBD();
    clearDB();
    fillBD();
    redirect();
}