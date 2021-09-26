<?php

include ("./connexion_base.php");
$request_method = $_SERVER["REQUEST_METHOD"];

$headers = apache_request_headers();

switch($request_method){
    case 'GET':
        if (!empty($_GET["album"])){
            getGroup($_GET["album"]);
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
            removeAlbum($_GET['album']);
        }else{
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');
        }
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

function postAlbum(){
    global $bdd;

    $PUT = json_decode(file_get_contents('php://input'), true);

    $nom = $PUT['nom'];
    $artiste = $PUT['lastfm'];
    $pistes = $PUT['tracks'];
    $sortie = $PUT['sortie'];
    $couverture = $PUT['couverture'];

    $req = $bdd->prepare('INSERT INTO albums(nom, artiste, pistes, sortie, couverture) VALUES(:nom, :artiste, :pistes, :sortie, :couverture)');
    $req->execute(array(
        'nom' => $nom,
        'artiste' => $artiste,
        'pistes' => $pistes,
        'sortie' => $sortie,
        'couverture' => $couverture
    )) or die(print_r($req->errorInfo()));
}

function getAlbum($id = "0"){
    global $bdd;
    $query = "SELECT * FROM albums";
    $reponse = array();

    if ($id != "0"){
        $query .= " WHERE id='{$id}' LIMIT 1";
    }

    $result = $bdd->query($query);
    $albums = $result->fetchAll(PDO::FETCH_ASSOC);

    foreach ($albums as $album){
        $reponse[] = $album;
    }

    header('Content-Type: application/json');
    echo json_encode($reponse, JSON_PRETTY_PRINT);
}

function editAlbumDetails($id){
    global $bdd;

    $PUT = json_decode(file_get_contents('php://input'), true);

    $success = true;
    $reponse = array();
    $done = false;
    $echecat = "";

    if (isset($PUT['nom']) && $success){
        if (!editData('albums', 'album', $PUT['nom'], "id={$id}")){
            $success = false;
            $echecat = "nom";
        }else{
            $done = true;
        }
    }

    if (isset($PUT['id']) && $success){
        if (!editData('albums', 'id', $PUT['id'], "id={$id}")){
            $success = false;
            $echecat = "id";
        }else{
            $done = true;
        }
    }

    if (isset($PUT['artiste']) && $success){
        if (!editData('albums', 'artiste', $PUT['artiste'], "id={$id}")){
            $success = false;
            $echecat = "artiste";
        }else{
            $done = true;
        }
    }

    if (isset($PUT['pistes']) && $success){
        if (!editData('albums', 'pistes', $PUT['pistes'], "id={$id}")){
            $success = false;
            $echecat = "pistes";
        }else{
            $done = true;
        }
    }

    if (isset($PUT['sortie']) && $success){
        if (!editData('albums', 'sortie', $PUT['sortie'], "id={$id}")){
            $success = false;
            $echecat = "pistes";
        }else{
            $done = true;
        }
    }

    if (isset($PUT['couverture']) && $success){
        if (!editData('albums', 'couverture', $PUT['couverture'], "id={$id}")){
            $success = false;
            $echecat = "pistes";
        }else{
            $done = true;
        }
    }

    if($success){
        $reponse = array('status' => 1, 'status_message' => 'Album mis à jour avec succès', 'done something' => $done);
    }else{
        $reponse = array('status' => 0, 'status_message' => 'Erreur lors de la mise à jours de album', 'at' => $echecat);
    }

    header('Content-Type: application/json');
    echo json_encode($reponse, JSON_PRETTY_PRINT);
}

function editData($table, $champ, $data, $where){
    global $bdd;
    if (!$bdd->query("UPDATE {$table} SET {$champ}='{$data}' WHERE {$where}")){
        return false;
    }else{
        return true;
    }
}

function removeAlbum($id){
    global $sqli_bdd;

    $reponse = array();

    if (!isset($_GET['album'])){
        if (mysqli_query($sqli_bdd, "TRUNCATE albums")){
            $reponse = array('status' => 1, 'status_message' => 'Albums retirés');
        }else{
            $reponse = array('status' => 0, 'status_message' => 'Une erreur est survenue lors du retrait de album');
        }
    }else{
        if (mysqli_query($sqli_bdd, "DELETE FROM albums WHERE id={$id}")){
            $reponse = array('status' => 1, 'status_message' => 'Album retiré');
        }else{
            $reponse = array('status' => 0, 'status_message' => 'Une erreur est survenue lors du retrait de album');
        }
    }

    header('Content-Type: application/json');
    echo json_encode($reponse, JSON_PRETTY_PRINT);
}