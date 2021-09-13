<?php
    $bdd = new PDO('mysql:host=localhost;dbname=musicpass;charset=utf8', 'root', 'root');

    $searchArg = null;

    if (isset($_POST['search'])){
        $searchArg = $_POST['search'];
    }

    $groupsToShow = array();
    $albumsToShow = array();

    $correspondingSearch = false;
    $correspondingType = -1;

    $reponse = null;

    if ($searchArg != "" && isset($searchArg)){

        $reponse = $bdd->query("SELECT * FROM groupes WHERE nom LIKE '{$searchArg}%'");

        while($donnees = $reponse->fetch()){
            $correspondingSearch = true;
            array_push($groupsToShow, $donnees);

            $albumReponse = $bdd->query("SELECT * FROM albums WHERE artiste='{$donnees['id']}'");

            while ($albumDonnees = $albumReponse->fetch()){
                array_push($albumsToShow, $albumDonnees);
            }
        }

        if (!$correspondingSearch){
            $reponse = $bdd->query("SELECT * FROM albums WHERE nom LIKE '{$searchArg}%'");

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

        $reponse = $bdd->query("SELECT * FROM groupes ");

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

<header class="mainHeader">
    <section class="logoSection">
        <img src="images/Logo.png">
    </section>

    <section class="researchSection">
        <form method="POST" name="MusicSearch">
            <fieldset class="transparentFieldSet">
                <input type="text" name="search" class="researchInput" placeholder="Recherche (Artiste, Album)" value="<?php echo $searchArg ?>"/>
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
            if ($correspondingSearch == false){
                shuffle($groupsToShow);
            }

            if ($correspondingSearch || $searchArg == null){
                foreach($groupsToShow as $group) {
                    $groupName = $group['nom'];
                    $groupGenres = explode("/*/", $group['genre']);

                    echo "<div class='groupCard'>
                        <section class='groupCard-Img-Section'>
                            <img class='albumCard-Img' src='images/NoCover.png'/>
                        </section>        
                        <section class='groupCard-Info-Section'>
                            <h2>$groupName</h2>
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

            if (strtolower($searchArg) === "patate"){
                echo "<img src='https://c.tenor.com/MynZDJ3KGiwAAAAC/mr-potato-work-out.gif' alt='kdo' title='kdo' />";
            }elseif (strtolower($searchArg) === "pasteque"){
                echo "<img src='https://c.tenor.com/unqFAepxyjcAAAAC/watermelon-watermelon-blast.gif' alt='kdo' title='kdo' />";
            }elseif(strtolower($searchArg) === "reh2"){
                echo "<img src='https://c.tenor.com/nJlxjsjqDLgAAAAC/tes-qui-tu-es-qui.gif' alt='kdo' title='kdo' />";
            }else{
                if ($correspondingSearch == false){
                    shuffle($albumsToShow);
                }

                if ($correspondingSearch || $searchArg == null) {
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
            }

        ?>
    </section>
</section>
<footer>
    <a href="#top"><img title="je ne suis présent que pour combler un trou béant" style="width: 15%; position: relative;left: 50%;" src="https://www.avantjetaisriche.com/wp-content/uploads/2015/06/monsieur-mr-patate-homer-simpson.jpg"/></a>
</footer>
</body>
</html>