<?php
    session_start();

    $albums_data = file_get_contents('https://filrouge.uha4point0.fr/music/albums');
    $albums =json_decode($albums_data,true);

    $group_data = file_get_contents('https://filrouge.uha4point0.fr/music/groupes');
    $groups = json_decode($group_data,true);

    $searchArg = $_POST['search'];
    $groupsToShow = array();
    $albumsToShow = array();

    $correspondingSearch = false;
    $correspondingType = -1;


    if ($searchArg != null){
        foreach ($groups as $group){
            //if (strtolower($group['nom']) == strtolower($searchArg)){
            if (substr(strtolower($group['nom']), 0, strlen($searchArg)) === strtolower($searchArg)){
                array_push($groupsToShow, $group);

                foreach (returnAlbums($albums, $group['id']) as $album){
                    array_push($albumsToShow, $album);
                }

                $correspondingSearch = true;
                $correspondingType = 0;
            }
        }

        if(!$correspondingSearch){
            foreach ($albums as $album){
                //if (strtolower($album['nom']) == strtolower($searchArg)){
                if (substr(strtolower($album['nom']), 0, strlen($searchArg)) === strtolower($searchArg)){
                    array_push($albumsToShow, $album);
                    array_push($groupsToShow, returnGroup($groups, $album['artiste']));

                    $correspondingSearch = true;
                    $correspondingType = 1;
                }
            }
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
            if ($album['artiste'] == $id){
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

<header class="mainHeader">
    <section class="logoSection">
        <img title="je ne suis présent que pour combler un trou béant" style="width: 50%" src="https://www.avantjetaisriche.com/wp-content/uploads/2015/06/monsieur-mr-patate-homer-simpson.jpg"/>
    </section>

    <section class="researchSection">
        <form method="POST" name="MusicSearch">
            <fieldset class="transparentFieldSet">
                <input type="text" name="search" class="researchInput" placeholder="Recherche (Artiste, Album)" value="<?php echo $_POST['search'] ?>"/>
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

    </section>

    <section id="groupContent" class="groupContent">
        <?php
            if ($correspondingSearch == false){
                $groupsToShow = $groups;
                shuffle($groupsToShow);
            }

            if ($correspondingSearch || $searchArg == null){
                foreach($groupsToShow as $group) {
                    $groupName = $group['nom'];
                    $groupChanteur = $group['chanteur'];
                    $groupOrigin = $group['origin'];
                    $groupGenres = $group['genre'];

                    echo "<div class='groupCard'>
                        <section class='groupCard-Img-Section'>
                            <img class='albumCard-Img' src='images/NoCover.png'/>
                        </section>        
                        <section class='groupCard-Info-Section'>
                            <h2>$groupName</h2>
                            <h3>$groupChanteur</h3>
                            <h4>$groupOrigin</h4>
                        </section>
                        <section class='groupCard-Genre-Section'>";

                    foreach ($groupGenres as $genre) {
                        echo "<button>$genre</button>";
                    }

                    echo "
                    </div>";
                }
            }else{
                echo "fromage";
            }

        ?>
    </section>

    <section class="contentHeader">

    </section>

    <section id="albumContent" class="albumContent">
        <?php

            if ($correspondingSearch == false){
                $albumsToShow = $albums;
                shuffle($albumsToShow);
            }

            if ($correspondingSearch || $searchArg == null) {
                foreach ($albumsToShow as $album) {
                    $album_pochette_url = $album['couverture'];
                    $album_name = $album['nom'];
                    $album_sortie = $album['sortie'];
                    $album_pistes = $album['pistes'];
                    $album_group_index = $album['artiste'];
                    $album_group = returnGroup($groups, $album_group_index);
                    $album_group_name = $album_group['nom'];

                    echo "<div class='albumCard'>
                                <section class='albumCard-pochette-Section'>
                                    <img class='albumCard-pochette' src='$album_pochette_url'/>
                                </section>
                    
                                <section class='albumCard-Info-Section'>
                                    <h2>$album_name</h2>
                                    <h3>$album_group_name</h3>
                                    <h4>$album_sortie</h4>
                                    <h4>$album_pistes</h4>
                                </section>
                    
                                <section class='albumCard-Action-Section'>
                                    <button>Je l'ai écouté !</button>
                                    <button>Favoris</button>
                                </section>
                            </div>";
                }
            }else{
                echo 'coucou';
            }
        ?>
    </section>
</section>
<footer>
    <a href="#top"><img title="je ne suis présent que pour combler un trou béant" style="width: 15%; position: relative;left: 50%;" src="https://www.avantjetaisriche.com/wp-content/uploads/2015/06/monsieur-mr-patate-homer-simpson.jpg"/></a>
</footer>
</body>
</html>
