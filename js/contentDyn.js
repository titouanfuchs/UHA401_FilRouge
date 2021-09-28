const groupContent = document.getElementById("groupContent");

document.onload = initPage();

function initPage(){ //Initialisation de la page avec tout les éléments de la recherche
    readAPI("groupes?count").then(function (count){
        createPaginationButtons(Math.ceil(count/5), "groupPaginationButtons", "groupChangePageNoSearch");
    });
    if (sessionStorage.getItem('groupPage') === null){
        sessionStorage.setItem('groupPage', '1');
        getGroupSearch(null,1);
    }else{
        console.log(sessionStorage.getItem("groupPage"));
        getGroupSearch(null,sessionStorage.getItem("groupPage"));
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

function getGroupSearch(arg, page){
    groupLoading();

    sleep(750).then(() => {
        if (arg == null){ //Quand pas de recherche effectuée;
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
            createGroupCard();
        }
    })
}

function groupLoading(){
    groupContent.innerHTML = "";
    const newCard = document.createElement("div");
    newCard.classList.add("loadingCard");

    newCard.innerHTML = '<object type="text/html" data="./animations/3dloading.html" height="100%""></object>';

    groupContent.style.justifyContent = "center";
    groupContent.appendChild(newCard);
}

function groupChangePageNoSearch(page){
    sessionStorage.setItem("groupPage", page.toString());
    getGroupSearch(null, page);
}

function createPaginationButtons(count, parent, fct){
    document.getElementById(parent).innerHTML = "";
    for (let i = 0; i < count; i++){
        let button = document.createElement("Button");
        button.setAttribute("onClick", fct + "(" + (i+1) + ");");
        button.innerText = i + 1;

        document.getElementById(parent).appendChild(button);
    }
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

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}