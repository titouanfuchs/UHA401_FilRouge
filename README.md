## Installation
Pour installer et utiliser le projet il suffit de mettre tout le contenu de cette branche dans un serveur apache (dans le dossier htdocs de xampp par exemple).

## Initialisation
Lors de la première initialisation il faut générer la base de données.

- Pour commencer, dans  `connexion_base.php` il faut changer si nécéssaire le nom d'utilisateur et le mot de passe de la base de données.
    ```php
    <?php
    session_start();
    $_SESSION['user'] = 'root'; //ici
    $_SESSION['pass'] = '';  //ici
    ```
- Une fois les modifications réalisées, il faut se rendre sur la page `dbBuild.php` (sois avec `localhost/addresse/vers/le/site/dbBuild`, sois avec `localhost/addresse/vers/le/site/dbBuild.php`). La base données va se générer et rediriger vers `index.php`

## API
Il y a 4 API.
- `albums` : Contient tous les albums. (`localhost/addresse/vers/le/site/API/albums`)
    - `albums/<id>` : Affiche un album par son `<id>`
- `details` : Contient tous les détails des albums (`localhost/addresse/vers/le/site/API/details`)
    - `details/<album>` : Affiche les détails d'un album par l'id de l'album correspondant
- `groupes` : Contient tous les groupes. (`localhost/addresse/vers/le/site/API/groupes`)
    - `groupes/<id>` : Affiche un groupe par son `<id>`
- `recherche` : Permet de rechercher dans les API `groupes` et `albums` (`localhost/addresse/vers/le/site/API/recherche`)
    - `recherche?search=<recherche>` : Affiche tout les albums et groupes pouvant correspondre à la `<recherche>`
