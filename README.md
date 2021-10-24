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


