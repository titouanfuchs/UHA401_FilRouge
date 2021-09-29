<?php
    require ("connexion_base.php");
    require ("lastfmTrackReader.php");

    global $bdd;

    if (isset($_GET['albumPage'])){
        $_SESSION['AlbumPage'] = $_GET['albumPage'];
    }else{
        $_SESSION['AlbumPage'] = 0;
    }

    if (isset($_GET['groupPage'])){
        $_SESSION['GroupPage'] = $_GET['groupPage'];
    }else{
        $_SESSION['GroupPage'] = 0;
    }

    //Details
    $showInfo = false;
    $showID = -1;

    if (isset($_GET['info'])){
        $showID = $_GET['info'];
        $showInfo = true;
    }
    //Fin Details

    if (isset($_GET['search'])){
        if ($_GET['search'] == ""){
            $_SESSION['searchArg'] = null;
        }else{
            $_SESSION['searchArg'] = htmlspecialchars($_GET['search']);
        }
    }else{
        $_SESSION['searchArg'] = null;
    }

    $groupsToShow = array();
    $albumsToShow = array();

    $correspondingSearch = false;
    $correspondingType = -1;

    $countAlbum = 0;
    $countAlbumresult = $bdd->query("SELECT COUNT(*) FROM albums");

    $countGroup = 0;
    $countGroupResult = $bdd->query("SELECT COUNT(*) FROM groupes");

    while($donnees = $countAlbumresult->fetch()){
        $countAlbum = $donnees[0];
    }

    while($donnees = $countGroupResult->fetch()){
        $countGroup = $donnees[0];
    }

    $reponse = null;

    if ($_SESSION['searchArg'] != null){
        $reponse = $bdd->query("SELECT * FROM groupes WHERE nom LIKE '{$_SESSION['searchArg']}%'");

        while($donnees = $reponse->fetch()){
            $correspondingSearch = true;
            array_push($groupsToShow, $donnees);

            $albumReponse = $bdd->query("SELECT * FROM albums WHERE artiste='{$donnees['id']}'");

            while ($albumDonnees = $albumReponse->fetch()){
                array_push($albumsToShow, $albumDonnees);
            }
        }

        if (!$correspondingSearch){
            $reponse = $bdd->query("SELECT * FROM albums WHERE nom LIKE '{$_SESSION['searchArg']}%'");

            while($donnees = $reponse->fetch()){
                $correspondingSearch = true;
                array_push($albumsToShow, $donnees);

                $groupReponse = $bdd->query("SELECT * FROM groupes WHERE id='{$donnees['artiste']}'");

                while($groupDonnees = $groupReponse->fetch()){
                    array_push($groupsToShow, $groupDonnees);
                }
            }
        }

        $countAlbum = count($albumsToShow);
        $countGroup = count($groupsToShow);
    }else{
        //Si aucune recherche n'est effectuée
        $AlbumPaginationCalc = 1 + 5 * $_SESSION['AlbumPage'];
        $GroupPaginationCalc = 1 + 5 * $_SESSION['GroupPage'];
        $reponse = $bdd->query("SELECT * FROM albums WHERE id >= {$AlbumPaginationCalc} LIMIT 5");

        while($donnees = $reponse->fetch()){
            array_push($albumsToShow, $donnees);
        }

        $reponse = $bdd->query("SELECT * FROM groupes WHERE id >= {$GroupPaginationCalc} LIMIT 5");

        while($donnees = $reponse->fetch()){
            array_push($groupsToShow, $donnees);
        }
    }

    $albumPageCount = intval(ceil($countAlbum / 5));
    $groupPageCount = intval(ceil($countGroup / 5));

        function returnGroup($groups, $id){
            global $bdd;
            $grouprep = $bdd->query("SELECT nom FROM groupes WHERE id = {$id}");

            while ($donnees = $grouprep->fetch()){
                return $donnees;
            }
        }

    function returnAlbums($albums, $id){
        $result = array();

        foreach ($albums as $album){
            if ($album['artiste'] === $id){
                array_push($result, $album);
            }
        }

        return $result;
    }

    /*echo $correspondingSearch;
    echo $correspondingType;*/
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>MusicPass</title>
    <link rel="stylesheet" href="style/style.css"/>
</head>

<body id="body">
<div class="topAnchor" id="top"></div>

<div class='infoBackground' id="albumInfo">
    <div class='bigInfo''>
    <section class='infoHeader'>
        <button onclick="hideAlbumDetails()">X</button>
    </section>
    <section class='infoPochetteContainer'>
        <section class='infoPochette'>
            <img id="infoPochette"/>
        </section>
        <section class='infoTitre'>
            <h1 id="infoTitre"></h1>
        </section>
    </section>
    <section class='infoContainer'>
        <section class='infoLinks'>

        </section>
        <section id="pistesDetails" class='infoPistes'>

        </section>
    </section>
</div>
</div>

<header class="mainHeader">
    <section class="logoSection">
        <img src="images/Logo.png">
    </section>

    <section class="researchSection">
        <form method="GET" name="MusicSearch">
            <fieldset class="transparentFieldSet">
                <input type="text" name="search" class="researchInput" placeholder="Recherche (Artiste, Album)" value="<?php if (isset($_SESSION['searchArg'])) { echo $_SESSION['searchArg'];}?>"/>
                <input type="submit" value="Rechercher" class="researchSubmit"/>
            </fieldset>
            <fieldset class="transparentFieldSet">
            </fieldset>
        </form>
    </section>

    <section class="userSection">
        <img title="je ne suis présent que pour combler un trou béant" style="width: 50%" src="https://www.avantjetaisriche.com/wp-content/uploads/2015/06/monsieur-mr-patate-homer-simpson.jpg"/>
    </section>
</header>

<section id="mainSection" class="mainSection">
    <section class="contentHeader" id="groupHeader">
        <h1>Groupes</h1>
    </section>

    <section class="contentHeader" id="groupPaginationButtons">

    </section>

    <section id="groupContent" class="groupContent">

    </section>

    <section class="contentHeader" id="albumHeader">
        <h1>Albums</h1>
    </section>

    <section class="contentHeader" id="albumPaginationButtons">

    </section>

    <section id="albumContent" class="albumContent">

    </section>
</section>
<footer>
    <img id="eheh" onclick="flipEheh()" title="je ne suis présent que pour combler un trou béant" style="width: 15%; position: relative;left: 50%;" src="https://www.avantjetaisriche.com/wp-content/uploads/2015/06/monsieur-mr-patate-homer-simpson.jpg"/>
</footer>

<script type="text/javascript" src="js/contentDyn.js"></script>

</body>
</html>