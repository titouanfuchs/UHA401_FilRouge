const groupContent = document.getElementById("groupContent");

document.onload = initPage();

function initPage(){ //Initialisation de la page avec tout les éléments de la recherche
    getGroupSearch();

}

function readAPI(api){
    let data = fetch("./API/" + api)
        .then(function(res){
            if (res.ok){
                return res.json();
            }
        })
        .then(function(value){
            console.log("Lecture API " + api + " OK");
            return value;
        })
        .catch(function (err){
            console.log(err);
        });
    return data;
}

function getGroupSearch(arg){
    groupContent.innerHTML = "";

    if (arg == null){ //Quand pas de recherche effectuée;
        const groupes = readAPI("groupes");

        for (var groupe in groupes){
            
        }

        addGroupCard()
    }else{ //Quand une recherche est effectuée;
        addGroupCard();
    }
}

function addGroupCard(nom, chanteur, origine, genres){
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
        genreCase.innerText += genre;

        GenreSection.appendChild(genreCase);
    }

    newCard.appendChild(IMGSection);
    newCard.appendChild(InfoSection);
    newCard.appendChild(GenreSection);

    groupContent.appendChild(newCard);
}