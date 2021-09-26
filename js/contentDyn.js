const groupCard = "<div class='groupCard'>\n" +
    "\t<section class='groupCard-Img-Section'>\n" +
    "\t\t<img class='albumCard-Img' src='images/NoCover.png'/>\n" +
    "\t</section>        \n" +
    "\t<section class='groupCard-Info-Section'>\n" +
    "\t\t<h2>$groupName</h2>\n" +
    "\t\t<h3>Chanteur : $groupChanteur</h3>\n" +
    "\t\t<h3>Origine : $groupOrigin</h3>\n" +
    "\t</section>\n" +
    "\t<section class='groupCard-Genre-Section'>\n" +
    "</div>";

const groupContent = document.getElementById("groupContent");

function addGroupCard(){
    groupContent.innerHTML += groupCard;
    console.log("test");
}