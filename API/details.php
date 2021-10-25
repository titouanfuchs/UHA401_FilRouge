<?php
require("../connexion_base.php");

$request_method = $_SERVER["REQUEST_METHOD"];

$headers = getallheaders();
$auth = "NONE";

if (isset($headers['authorization'])){
    $auth = $headers['authorization'];
}else if (isset($headers['Authorization'])){
    $auth = $headers['Authorization'];
}

header('Content-Type: application/json');

switch($request_method){
    case 'GET':
        if (!empty($_GET["album"])){
            getAlbumDetails($_GET["album"]);
        }else{
            getAlbumDetails();
        }
        break;
    case 'POST':
        if ($auth == $_SESSION['APIPASS']) {
            postAlbumDetails();
        }else{
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');

            echo "Accès non autorisé !";
        }
        break;
    case 'PUT':
        if ($auth == $_SESSION['APIPASS']) {
            editAlbumDetails($_GET['album']);
        }else{
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');
        }
        break;
    case 'DELETE':
        if ($auth == $_SESSION['APIPASS']) {
            removeAlbumDetails($_GET['album']);
        }else{
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');
        }
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

function postAlbumDetails(){
    global $bdd;
    global $sqli_bdd;

    $reponse = array();

    $PUT = json_decode(file_get_contents('php://input'), true);

    if (isset($PUT['album']) && isset($PUT['lastfm']) && isset($PUT['description'])){
        $req = $bdd->prepare('INSERT INTO details(album, lastfm, description) VALUES(:album, :lastfm, :description)');
        $req->execute(array(
            'album' => $PUT['album'],
            'lastfm' => $PUT['lastfm'],
            'description' => $PUT['description']
        ));

        if (isset($PUT['tracks'])){
            $tracks = $PUT['tracks'];
            foreach ($tracks as $track){
                $req = $bdd->prepare('INSERT IGNORE INTO tracks(albumID, trackNum, nom, duree) VALUES(:albumID, :trackNum, :nom, :duree)');
                $req->execute(array(
                    'albumID' => $track['albumID'],
                    'trackNum' => $track['trackNum'],
                    'nom' => $track['nom'],
                    'duree' => strval($track['duree'])
                ));
            }
        }

        if ($req->errorCode() == 0){
            $reponse = array('status' => 1, 'status_message' => 'Ajout réussis !');
        }else{
            $reponse = array('status' => 0, 'status_message' => 'Echec de l ajout.', 'err' => $req->errorInfo()[2]);
        }
    }else{
        $reponse = array('status' => 0, 'status_message' => 'Echec de l ajout. Il manque un ou plusieurs champs.');
    }

    header('Content-Type: application/json');
    echo json_encode($reponse, JSON_PRETTY_PRINT);
}

function getAlbumDetails($id = "0"){
    global $sqli_bdd;
    global $bdd;
    $query = "SELECT * FROM details";
    $reponse = array();

    if ($id != "0"){
        $query .= " WHERE album='{$id}' LIMIT 1";
    }

    $result = $bdd->query($query);
    $hadDetails = false;
    $details = $result->fetchAll(PDO::FETCH_ASSOC);

    foreach($details as $detail){
        $tracks = $bdd->query("SELECT * FROM tracks WHERE albumID = {$detail['album']}")->fetchAll(PDO::FETCH_ASSOC);
        $detail['tracks'] = json_encode($tracks);
        $reponse[] = $detail;
        $hadDetails = true;
    }

    if (!$hadDetails && $id != "0"){
        $reponse = array('status' => 0, 'status_message' => 'Aucun résultat');
    }
    header('Content-Type: application/json');
    echo json_encode($reponse, true);
}

function editAlbumDetails($id){
    global $sqli_bdd;
    global $bdd;

    $PUT = json_decode(file_get_contents('php://input'), true);

    $success = true;
    $reponse = array();
    $done = false;
    $echecat = "";
    $sql_err = "";

    if (isset($PUT['album']) && $success){
        if (!mysqli_query($sqli_bdd, "UPDATE details SET album={$PUT['album']} WHERE album={$id}")){
            $success = false;
            $echecat = "album";
            $sql_err = mysqli_error($sqli_bdd);
        }else{
            $done = true;
        }
    }

    if (isset($PUT['lastfm']) && $success){
        if (!mysqli_query($sqli_bdd, "UPDATE details SET lastfm='{$PUT['lastfm']}' WHERE album={$id}")){
            $success = false;
            $echecat = "lastfm";
            $sql_err = mysqli_error($sqli_bdd);
        }else{
            $done = true;
        }
    }

    if (isset($PUT['description']) && $success){
        $req = $bdd->prepare("UPDATE details SET description= :description WHERE album={$id}");
        $req->execute(array(
            'description' => strval($PUT['description'])
        ));
        if ($req->errorCode() != 0){
            $sql_err = $req->errorInfo();
            $success = false;
            $echecat = "description";
        }else{
            $done = true;
        }
    }

    if (isset($PUT['tracks']) && $success){
        foreach ($PUT['tracks'] as $track){
            $contains = $bdd->query("SELECT COUNT(*) FROM tracks WHERE albumID='{$track['albumID']}' AND trackNum='{$track['trackNum']}'")->fetchAll(PDO::FETCH_ASSOC)[0]['COUNT(*)'];
            if ($contains === "0"){
                $req = $bdd->prepare('INSERT INTO tracks(albumID, trackNum, nom, duree) VALUES(:albumID, :trackNum, :nom, :duree)');
                $req->execute(array(
                    'albumID' => $track['albumID'],
                    'trackNum' => $track['trackNum'],
                    'nom' => $track['nom'],
                    'duree' => strval($track['duree'])
                ));
            }else{
                $req = $bdd->prepare("UPDATE tracks SET trackNum=:trackNum, nom=:nom, duree=:duree WHERE albumID='{$track['albumID']}' AND trackNum='{$track['trackNum']}'");
                $req->execute(array(
                    'trackNum' => $track['trackNum'],
                    'nom' => strval($track['nom']),
                    'duree' => strval($track['duree'])
                ));
            }

            if ($req->errorCode() != 0){
                $sql_err = $req->errorInfo();
                $success = false;
                $echecat = "tracks";
                break;
            }else{
                $done = true;
            }
        }
    }

    if($success){
        $reponse = array('status' => 1, 'status_message' => 'Details mis à jour avec succès', 'done something' => $done);
    }else{
        $reponse = array('status' => 0, 'status_message' => 'Erreur lors de la mise à jours des détails', 'sql_err' => $sql_err,'at' => $echecat);
    }

    header('Content-Type: application/json');
    echo json_encode($reponse, JSON_PRETTY_PRINT);
}

function removeAlbumDetails($id){
    global $sqli_bdd;

    $reponse = array();

    if (!isset($_GET['album'])){
        if (mysqli_query($sqli_bdd, "TRUNCATE details")){
            $reponse = array('status' => 1, 'status_message' => 'Details retirés');
        }else{
            $reponse = array('status' => 0, 'status_message' => 'Une erreur est survenue lors du retrait des details');
        }
    }else{
        if (mysqli_query($sqli_bdd, "DELETE FROM details WHERE album={$id}")){
            mysqli_query($sqli_bdd, "DELETE FROM tracks WHERE albumID={$id}");
            $reponse = array('status' => 1, 'status_message' => 'Details retirés');
        }else{
            $reponse = array('status' => 0, 'status_message' => 'Une erreur est survenue lors du retrait des details');
        }
    }

    header('Content-Type: application/json');
    echo json_encode($reponse, JSON_PRETTY_PRINT);
}

function returnAlbum($id = "0", $page = "-1"){
    global $bdd;
    $query = "SELECT * FROM albums";
    $reponse = array();

    if ($id != "0"){
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

    foreach ($albums as $album){
        $groupeResult = $bdd->query("SELECT nom FROM groupes WHERE id={$album['artiste']}");
        $artiste = $groupeResult->fetchAll();

        $album['artiste'] = $artiste[0]['nom'];
        $reponse[] = $album;
    }

    return $reponse;
}
