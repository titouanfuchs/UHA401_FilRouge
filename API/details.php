<?php

include ("../connexion_base.php");
$request_method = $_SERVER["REQUEST_METHOD"];

$headers = apache_request_headers();

switch($request_method){
    case 'GET':
        if (!empty($_GET["album"])){
            getAlbumDetails($_GET["album"]);
        }else{
            getAlbumDetails();
        }
        break;
    case 'POST':
        if ($headers['Authorization'] == $_SESSION['APIPASS']) {
            postAlbumDetails();
        }else{
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');

            echo "Accès non autorisé !";
        }
        break;
    case 'PUT':
        if ($headers['Authorization'] == $_SESSION['APIPASS']) {
            editAlbumDetails($_GET['album']);
        }else{
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');
        }
        break;
    case 'DELETE':
        if ($headers['Authorization'] == $_SESSION['APIPASS']) {
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

    $album = $_POST['album'];
    $lastfm = $_POST['lastfm'];
    $tracks = $_POST['tracks'];

    $req = $bdd->prepare('INSERT INTO details(album, lastfm, tracks) VALUES(:album, :lastfm, :tracks)');
    $req->execute(array(
        'album' => $album,
        'lastfm' => $lastfm,
        'tracks' => $tracks
    )) or die(print_r($req->errorInfo()));
}

function getAlbumDetails($id = "0"){
    global $sqli_bdd;
    $query = "SELECT * FROM details";
    $reponse = array();

    if ($id != "0"){
        $query .= " WHERE album='{$id}' LIMIT 1";
    }

    $result = mysqli_query($sqli_bdd,$query);

    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
        $reponse[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($reponse, JSON_PRETTY_PRINT);
}

function editAlbumDetails($id){
    global $sqli_bdd;
    global $bdd;

    $PUT = json_decode(file_get_contents('php://input'), true);

    $success = true;
    $reponse = array();
    $done = false;
    $echecat = "";

    if (isset($PUT['album']) && $success){
        if (!mysqli_query($sqli_bdd, "UPDATE details SET album={$PUT['album']} WHERE album={$id}")){
            $success = false;
            $echecat = "album";
        }else{
            $done = true;
        }
    }

    if (isset($PUT['lastfm']) && $success){
        if (!mysqli_query($sqli_bdd, "UPDATE details SET lastfm='{$PUT['lastfm']}' WHERE album={$id}")){
            $success = false;
            $echecat = "lastfm";
        }else{
            $done = true;
        }
    }

    if (isset($PUT['tracks']) && $success){
        $jsonTracks = json_encode($PUT['tracks']);

        if (!mysqli_query($sqli_bdd, "UPDATE details SET tracks='{$jsonTracks}' WHERE album={$id}")){
            $success = false;
            $echecat = "tracks";
        }else{
            $done = true;
        }
    }

    if($success){
        $reponse = array('status' => 1, 'status_message' => 'Details mis à jour avec succès', 'done something' => $done);
    }else{
        $reponse = array('status' => 0, 'status_message' => 'Erreur lors de la mise à jours des détails', 'at' => $echecat);
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
            $reponse = array('status' => 1, 'status_message' => 'Details retirés');
        }else{
            $reponse = array('status' => 0, 'status_message' => 'Une erreur est survenue lors du retrait des details');
        }
    }

    header('Content-Type: application/json');
    echo json_encode($reponse, JSON_PRETTY_PRINT);
}
