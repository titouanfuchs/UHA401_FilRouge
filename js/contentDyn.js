const groupContent = document.getElementById("groupContent");
const albumContent = document.getElementById("albumContent");

const albumInfo = document.getElementById("albumInfo");
const pochetteInfo = document.getElementById("infoPochette");
const titreInfo = document.getElementById("infoTitre");
const pisteInfo = document.getElementById("pistesDetails");

document.onload = initPage();

function initPage(){ //Initialisation de la page avec tout les éléments de la recherche
    if (sessionStorage.getItem('searchArg') === null || sessionStorage.getItem('searchArg') == ""){
        if (sessionStorage.getItem('groupPage') === null){
            sessionStorage.setItem('groupPage', '1');
        }else{
            console.log(sessionStorage.getItem("groupPage"));
            getGroupSearch(null,sessionStorage.getItem("groupPage"));
        }

        if (sessionStorage.getItem('albumPage') === null){
            sessionStorage.setItem('albumPage', '1');
        }else{
            //console.log(sessionStorage.getItem("albumPage"));
            getAlbumSearch(null,sessionStorage.getItem("albumPage"));
        }

        search();
    }else{
        search(sessionStorage.getItem('searchArg'));
    }
}

function readAPI(api){
    let data = fetch("./API/" + api)
        .then(function(res){
            if (res.ok){
                return res.json();
            }
        })
        .then(function(value){
            //console.log("Lecture API " + api + " OK");
            return value;
        })
        .catch(function (err){
            console.log(err);
        });
    return data;
}

function search(){
    document.getElementById("researchSubmit").disabled = true;

    sleep(1000).then(() => {
        document.getElementById("researchSubmit").disabled = false;
    })

   let arg = document.getElementById("researchValue").value;
   sessionStorage.setItem("searchArg", arg);

   if (arg !== ""){
       console.log("coucou");
       readAPI("recherche?search=" + arg).then(function (result){
           document.getElementById("albumPaginationButtons").innerHTML = "";
           document.getElementById("groupPaginationButtons").innerHTML = "";

           const groupes = result['groupes'];
           const albums = result['albums'];

           if (groupes.length > 0){
               getGroupSearch(groupes);
           }else{
               LoadingCard(groupContent);

               sleep(400).then(() =>{
                   groupContent.innerHTML = "";
                   createNoResultCard(groupContent);
               })
           }

           if (albums.length > 0){
               getAlbumSearch(albums);
           }else{
               LoadingCard(albumContent);

               sleep(400).then(() =>{
                   albumContent.innerHTML = "";
                   createNoResultCard(albumContent);
               })
           }
       })
   }else{
       readAPI("groupes?count").then(function (count){
           createPaginationButtons(Math.ceil(count/5), "groupPaginationButtons", "groupChangePage");
       });

       readAPI("albums?count").then(function (count){
           createPaginationButtons(Math.ceil(count/5), "albumPaginationButtons", "albumChangePage");
       });

       groupChangePage(1);
       albumChangePage(1);
   }
}

function getAlbumSearch(albumData, page){
    LoadingCard(albumContent);

    sleep(400).then(() => {
        if (albumData == null){ //Quand pas de recherche effectuée;
            readAPI("albums?page=" + page.toString()).then(function(albums){
                let albumArray = Object.values(albums);
                albumContent.innerHTML = "";
                for (let al in albums){
                    let album = albumArray[al];

                    createAlbumCard(album['id'], album['nom'], album['artiste'], album['sortie'], album['pistes'], album['couverture'], al);
                }
            });
        }else{ //Quand une recherche est effectuée;
            let albumArray = Object.values(albumData);
            albumContent.innerHTML = "";
            for (let al in albumData){
                let album = albumArray[al];

                createAlbumCard(album['id'], album['nom'], album['artiste'], album['sortie'], album['pistes'], album['couverture'], al);
            }
        }
    })
}

function getGroupSearch(groupes, page){
    LoadingCard(groupContent);

    sleep(400).then(() => {
        if (groupes == null){ //Quand pas de recherche effectuée;
            readAPI("groupes?page=" + page.toString()).then(function(groupes){
                let groupArray = Object.values(groupes);
                groupContent.style.justifyContent = "left";
                groupContent.innerHTML = "";
                for (let gr in groupes){
                    let groupe = groupArray[gr];

                    createGroupCard(groupe['nom'], groupe['chanteur'], groupe['origin'], groupe['genres'], gr);
                }
            });
        }else{ //Quand une recherche est effectuée;
            let groupArray = Object.values(groupes);
            groupContent.style.justifyContent = "left";
            groupContent.innerHTML = "";
            for (let gr in groupes){
                let groupe = groupArray[gr];

                createGroupCard(groupe['nom'], groupe['chanteur'], groupe['origin'], groupe['genres'], gr);
            }
        }
    })
}

function LoadingCard(container){
    container.innerHTML = "";
    const newCard = document.createElement("div");
    newCard.classList.add("loadingCard");

    newCard.innerHTML = '<object type="text/html" data="./animations/3dloading.html" height="100%" alt="Chargement..." title="Chargement..."></object>';

    container.style.justifyContent = "center";
    container.appendChild(newCard);
}

function groupChangePage(page){
    document.getElementById("groupPaginationButtons_" + (page-1)).disabled = true;
    sleep(1000).then(() => {
        document.getElementById("groupPaginationButtons_" + (page-1)).disabled = false;
    })
    sessionStorage.setItem("groupPage", page.toString());

    getGroupSearch(null, page);
}

function albumChangePage(page){
    document.getElementById("albumPaginationButtons_" + (page-1)).disabled = true;
    sleep(1000).then(() => {
        document.getElementById("albumPaginationButtons_" + (page-1)).disabled = false;
    })
    sessionStorage.setItem("albumPage", page.toString());
    getAlbumSearch(null, page);
}

function showAlbumDetails(id){
    pisteInfo.innerHTML = "";

    readAPI("albums?album=" + id).then(function (albums){
        let album = albums[0];
        pochetteInfo.setAttribute("src", album['couverture']);
        titreInfo.innerText = album['nom'];
        albumInfo.style.display = "block";

        readAPI("details?album="+id).then(function(details){
            let pistes = JSON.parse(details[0]['tracks']);

            for (let piste in pistes){
                createPisteCard(parseInt(pistes[piste]['id']), pistes[piste]['nom'], pistes[piste]['duree'])
            }
        })
    });
}

function hideAlbumDetails(){
    albumInfo.style.display = "none";
}

function createPaginationButtons(count, parent, fct){
    document.getElementById(parent).innerHTML = "";
    for (let i = 0; i < count; i++){
        let button = document.createElement("Button");
        button.setAttribute("id", parent + "_" + i);
        button.setAttribute("onClick", fct + "(" + (i+1) + ")");
        button.classList.add("paginationButton");
        button.innerText = i + 1;

        document.getElementById(parent).appendChild(button);
    }
}

function createNoResultCard(parent){
    const newCard = document.createElement("div");
    newCard.classList.add("Card");

    const section = document.createElement("section");
    section.classList.add("noResult")

    section.innerHTML = "<h1>Aucun résultat</h1>";

    newCard.appendChild(section);

    parent.appendChild(newCard);
}

function createPisteCard(id, nom, duree){
    const newCard = document.createElement("div");
    newCard.classList.add("track");

    const idSection = document.createElement("section");
    idSection.classList.add("track-id-section");
    idSection.innerText = id;

    const nomSection = document.createElement("section");
    nomSection.classList.add("track-title-section");
    nomSection.innerText = nom;

    const dureeSection = document.createElement("section");
    dureeSection.classList.add("track-duration-section");
    dureeSection.innerText = duree;

    newCard.appendChild(idSection);
    newCard.appendChild(nomSection);
    newCard.appendChild(dureeSection);

    pisteInfo.appendChild(newCard);
}

function createAlbumCard(albumId, nom, groupe, sortie, pistes, pochette, id){
    const newCard = document.createElement("div");
    newCard.classList.add("albumCard");

    const pochetteSection = document.createElement("section");
    pochetteSection.classList.add("albumCard-pochette-Section");
    pochetteSection.innerHTML = "<img class='albumCard-pochette' src='" + pochette + "'/>"

    const infoSection = document.createElement("section");
    infoSection.classList.add("albumCard-Info-Section");

    const album_nom = document.createElement("h2");
    album_nom.innerText = nom;

    const album_Groupe = document.createElement("h3");
    album_Groupe.innerText = groupe;

    const album_Sortie = document.createElement("h3");
    album_Sortie.innerText = sortie;

    infoSection.appendChild(album_nom);
    infoSection.appendChild(album_Groupe);
    infoSection.appendChild(album_Sortie);

    const actionSection = document.createElement("section");
    actionSection.classList.add("albumCard-Action-Section");

    const detailAction = document.createElement("button");
    detailAction.setAttribute("onClick", "showAlbumDetails(" + albumId + ");");
    detailAction.innerText = "Voir plus de détails";
    actionSection.appendChild(detailAction);

    newCard.appendChild(pochetteSection);
    newCard.appendChild(infoSection);
    newCard.appendChild(actionSection);

    sleep(100 * id).then(() => {albumContent.appendChild(newCard);});
}

function createGroupCard(nom, chanteur, origine, genres, id){
    //Creation de la nouvelle Carte
    const newCard = document.createElement("div");
    newCard.classList.add("groupCard");

    //Section IMG
    const IMGSection = document.createElement("section");
    IMGSection.classList.add("groupCard-Img-Section");

    const IMG = document.createElement("img");
    IMG.classList.add("albumCard-Img");
    IMG.setAttribute("src", "images/NoCover.png");

    IMGSection.appendChild(IMG);

    //Section Info
    const InfoSection = document.createElement("section");
    InfoSection.classList.add("groupCard-Info-Section");

    const groupName = document.createElement("h2");
    groupName.innerText += nom;

    const groupChanteur = document.createElement("h3");
    groupChanteur.innerText += "Chanteur : " + chanteur;

    const groupOrigin = document.createElement("h3");
    groupOrigin.innerText += "Origine : " + origine;

    InfoSection.appendChild(groupName);
    InfoSection.appendChild(groupChanteur);
    InfoSection.appendChild(groupOrigin);

    //Genre Section
    const GenreSection = document.createElement("section");
    GenreSection.classList.add("groupCard-Genre-Section");

    for(let genre in genres){
        let genreCase = document.createElement("button");
        genreCase.innerText += genres[genre]['nom'];

        GenreSection.appendChild(genreCase);
    }

    newCard.appendChild(IMGSection);
    newCard.appendChild(InfoSection);
    newCard.appendChild(GenreSection);

    sleep(100 * id).then(() => {groupContent.appendChild(newCard);});

}

function flipEheh(){
    alert("Z'est partiiiii");
    sleep(2000).then(() => {document.getElementById("body").classList.add("flipPage");});
    //sleep(2000).then(() => {document.getElementById("body").classList.remove("flipPage")});

}

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}