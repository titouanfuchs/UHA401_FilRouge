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
        <section class="transparentFieldSet">
            <input type="text" name="search" class="researchInput" placeholder="Recherche..." id="researchValue" onchange="search()"/>
            <button class="researchSubmit" id="researchSubmit" onclick="search()">Rechercher</button>
        </section>
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