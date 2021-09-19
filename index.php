<?php
    include ("connexion_base.php");
    include ("lastfmTrackReader.php");

    if (isset($_GET['action'])){ //Option permettant de remettre la base de données en l'état d'origine
        if ($_GET['action'] == 'RESET'){
            $bdd->query("DELETE FROM albums WHERE default_entity='false'");
            $bdd->query("DELETE FROM groupes WHERE default_entity='false'");
            $bdd->query("TRUNCATE details");
        }
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
    }else{
        //Si aucune recherche n'est effectuée

        $reponse = $bdd->query("SELECT * FROM albums");

        while($donnees = $reponse->fetch()){
            array_push($albumsToShow, $donnees);
        }

        $reponse = $bdd->query("SELECT * FROM groupes");

        while($donnees = $reponse->fetch()){
            array_push($groupsToShow, $donnees);
        }
    }

    function returnGroup($groups, $id){
        foreach ($groups as $group){
            if ($group['id'] == $id){
                return $group;
            }
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

<body>
<div class="topAnchor" id="top"></div>

<?php
    //Affichage des infos détaillées d'un album
    if($showInfo){
        $albumRep = $bdd->query("SELECT * FROM albums WHERE id='{$showID}' ");
        $aDataTableDetailHTML = null;
        $aDataTableHeaderHTML = null;

        $i = 1;

        while ($album = $albumRep->fetch()){
            $group = returnGroup($groupsToShow, $album['artiste']);
            $tracks = array();

            $reponse = $bdd->query("SELECT * FROM details WHERE album={$album['id']}");
            $hadDetails = false;
            while($donnees = $reponse->fetch()) {
                $hadDetails = true;
                $tracks = json_decode($donnees['tracks'], true);
            }

            if (!$hadDetails){
                $data = readData($group['nom'], $album['nom']);
                $newDetail = array();

                if (count($data) > 0){
                    foreach ($data as $track){
                        $newTrack = array('id'=>$track[0], 'nom'=>$track[3], 'duree'=>$track[7]);
                        array_push($tracks, $newTrack);
                    }

                    $req = $bdd->prepare('INSERT INTO details(album, lastfm, tracks) VALUES(:album, :lastfm, :tracks)');
                    $req->execute(array(
                        'album' => $album['id'],
                        'lastfm' => returnURL($group['nom'], $album['nom']),
                        'tracks' => json_encode($tracks)
                    )) or die(print_r($req->errorInfo()));
                }
            }

            echo "<div class='infoBackground'>
                    <div class='bigInfo''>
                        <section class='infoHeader'>
                            <a href='./?search={$_SESSION['searchArg']}'><button>X</button></a>
                        </section>
                        <section class='infoPochetteContainer'>
                            <section class='infoPochette'>
                                <img src='{$album['couverture']}'/>
                            </section>
                            <section class='infoTitre'>
                                <h1>"; echo $album['nom']; echo "</h1>
                            </section>
                        </section>
                        <section class='infoContainer'>
                            <section class='infoLinks'>
                        
                            </section>
                            <section class='infoPistes'>
                            ";
                                foreach ($tracks as $track){
                                    echo "
                                    <div class='track'>
                                        <section class='track-id-section'>
                                            {$i}
                                        </section>                             
                                        <section class='track-title-section'>
                                            {$track['nom']}
                                        </section>
                                        <section class='track-duration-section'>
                                            {$track['duree']}                                        
                                        </section>     
                                    </div>                                    
                                    ";
                                    $i++;
                                }
                                echo "
                            </section>
                        </section>
                    </div>
                  </div>";
        }
    }
?>
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
                <input type="submit" value="Proposez-moi quelque chose de nouveau !" class="randomSubmit" title="Choisis aléatoirement une musique, ou un album !"/>
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

    <section id="groupContent" class="groupContent">
        <?php
            $useRandom = false;
            if ($correspondingSearch == false && $_SESSION['searchArg'] == null){
                //shuffle($groupsToShow);
                $useRandom = true;
            }

            if ($correspondingSearch || $useRandom){
                foreach($groupsToShow as $group) {
                    $groupName = $group['nom'];
                    $groupChanteur = $group['chanteur'];
                    $groupOrigin = $group['origin'];
                    $groupGenres = explode(";", $group['genre']);

                    echo "<div class='groupCard'>
                        <section class='groupCard-Img-Section'>
                            <img class='albumCard-Img' src='images/NoCover.png'/>
                        </section>        
                        <section class='groupCard-Info-Section'>
                            <h2>$groupName</h2>
                            <h3>Chanteur : $groupChanteur</h3>
                            <h3>Origine : $groupOrigin</h3>
                        </section>
                        <section class='groupCard-Genre-Section'>";

                    foreach ($groupGenres as $genre) {
                        echo "<button>$genre</button>";
                    }

                    echo "
                    </div>";
                }
            }else{
                echo "<div class='Card'>
                              <div class='noResult '>
                                <h1>Aucun résultat</h1>
                              </div>
                          </div>";
            }

        ?>
    </section>

    <section class="contentHeader">
        <h1>Albums</h1>
    </section>

    <section id="albumContent" class="albumContent">
        <?php
        $useRandom = false;
        if ($correspondingSearch == false && $_SESSION['searchArg'] == null){
            //shuffle($albumsToShow);
            $useRandom = true;
        }

        if ($correspondingSearch || $useRandom) {
            foreach ($albumsToShow as $album) {
                $album_pochette_url = $album['couverture'];
                $album_name = $album['nom'];
                $album_sortie = $album['sortie'];
                $album_pistes = $album['pistes'];
                $album_group_index = $album['artiste'];
                $album_group = returnGroup($groupsToShow, $album_group_index);
                $album_group_name = $album_group['nom'];

                echo "<div class='albumCard'>
                                    <section class='albumCard-pochette-Section'>
                                        <img class='albumCard-pochette' src='$album_pochette_url'/>
                                    </section>
                        
                                    <section class='albumCard-Info-Section'>
                                        <section>
                                            <h2>$album_name</h2>
                                        </section>
                                        <section>
                                            <h3>Groupe : $album_group_name</h3>
                                        </section>
                                        <section>
                                            <h4>Sortie :$album_sortie</h4>
                                        </section>
                                        <section>
                                            <h4>Piste(s):$album_pistes</h4>
                                        </section>
                                    </section>
                        
                                    <section class='albumCard-Action-Section'>
                                        <button>Je l'ai écouté !</button>
                                        <button>Favoris</button>
                                        <a href='./?info={$album['id']}&search={$_SESSION['searchArg']}'><button>Plus d'infos</button></a>
                                    </section>
                                </div>";
            }
        }else{
            echo "<div class='Card'>
                              <div class='noResult '>
                                <h1>Aucun résultat</h1>
                              </div>
                          </div>";
        }

        ?>
    </section>
</section>
<footer>
    <img title="je ne suis présent que pour combler un trou béant" style="width: 15%; position: relative;left: 50%;" src="https://www.avantjetaisriche.com/wp-content/uploads/2015/06/monsieur-mr-patate-homer-simpson.jpg"/>
</footer>
</body>
</html>