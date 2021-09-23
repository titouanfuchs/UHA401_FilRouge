<?php

require ("connexion_base.php");

function buildBD(){

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
                array_push($genreid, $id);
            }

            $reponse = $bdd->query("SELECT * FROM groupes WHERE nom='{$groupe['nom']}'");
            $genreResult = $reponse->fetchAll();

            if (count($genreResult) == 0){
                pushGroupToBDD($groupe, $genreid);
            }
        }
    }

    foreach ($albums as $album){
        $reponse = $bdd->query("SELECT * FROM groupes WHERE id='{$album['artiste']}'");
        $groupReponse = $reponse->fetchAll();

        if (count($groupReponse) != 0){
            pushAlbumToBDD($album);
        }
    }
}

function pushGenreToBDD($genre){ //Remplissage des genres;
    global $bdd;
    $req = $bdd->prepare('INSERT INTO genres(nom) VALUES(:nom)');
    $req->execute(array(
        'nom' => $genre
    )) or die(print_r($req->errorInfo()));
}

function pushGroupToBDD($group, $genres){
    global $bdd;

    $req = $bdd->prepare('INSERT INTO groupes(nom, chanteur, origin, genre) VALUES(:nom, :chanteur, :origin, :genre)');
    $req->execute(array(
        'nom' => $group['nom'],
        'chanteur' => $group['chanteur'],
        'origin' => $group['origin'],
        'genre' => json_encode($genres, JSON_PRETTY_PRINT)
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

fillBD();
