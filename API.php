<?php

include ("connexion_base.php");
$args = json_decode($_GET["x"], true);

$table = $args['table'];
$action = $args['action'];

$stmt = null;
$done = false;

if ($action == "read"){
    $limit = $args['limit'];
    $stmt = $bdd->query("SELECT * FROM $table LIMIT {$args['limit']}");
    $done = true;
}elseif ($action == "add"){
    $newEntry = json_decode($_GET["entry"], true);

    if ($table == "albums"){
        $req = $bdd->prepare('INSERT INTO albums(nom, artiste, pistes, sortie, couverture) VALUES(:nom, :artiste, :pistes, :sortie, :couverture)');
        $req->execute(array(
            'nom' => $newEntry['nom'],
            'artiste' => $newEntry['artiste'],
            'pistes' => $newEntry['pistes'],
            'sortie' => $newEntry['sortie'],
            'couverture' => $newEntry['couverture']
        )) or die(print_r($req->errorInfo()));

        echo "Entrée ajoutée dans la table albums";
    }elseif ($table == "groupes"){
        $req = $bdd->prepare('INSERT INTO groupes(nom, chanteur, origin, genre) VALUES(:nom, :chanteur, :origin, :genre)');
        $req->execute(array(
            'nom' => $newEntry['nom'],
            'chanteur' => $newEntry['chanteur'],
            'origin' => $newEntry['origin'],
            'genre' => $newEntry['genre']
        )) or die(print_r($req->errorInfo()));
        echo "Entrée ajoutée dans la table groupes";
    }
}

if ($done){
    header("Content-Type: application/json; charset=UTF-8");

    $result = $stmt->fetchAll();
    echo json_encode($result);
}


