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
        if ($headers['Authorization'] == "jailedroit") {
            postAlbumDetails();
        }else{
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');

            echo "Accès non autorisé !";
        }
        break;
    case 'PUT':
        if ($headers['Authorization'] == "jailedroit") {
            editAlbumDetails($_GET['album']);
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


}