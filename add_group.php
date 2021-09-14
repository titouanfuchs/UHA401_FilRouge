<?php
    include("connexion_base.php");

    if (isset($_GET['groupName'])){
        $groupName = $_GET['groupName'];
        $groupChanteur = $_GET['groupChanteur'];
        $groupOrigin = $_GET['groupOrigin'];
        $groupGenre = $_GET['groupGenre'];

        $req = $_SESSION['bdd']->prepare('INSERT INTO groupes(nom, chanteur, origin, genre, default_entity) VALUES(:nom, :chanteur, :origin, :genre, :default_val)');
        $req->execute(array(
            'nom' => $groupName,
            'chanteur' => $groupChanteur,
            'origin' => $groupOrigin,
            'genre' => $groupGenre,
            'default_val' => "false"
        )) or die(print_r($req->errorInfo()));
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>MusicPass - Ajouter un groupe</title>
    </head>

    <body>
        <form method="get" action="add_group.php">
            <label>Nom du groupe : <input type="text" name="groupName" required/></label>
            <label>Chanteur du groupe : <input type="text" name="groupChanteur" required/></label>
            <label>Ville d'origine du groupe : <input type="text" name="groupOrigin" required/> </label>
            <label>Genre de musique du groupe : <textarea name="groupGenre" title="Chaque genre dois être séparé avec ';'" required></textarea></label>
            <input type="submit" value="Valider"/>
        </form>
    </body>
</html>
