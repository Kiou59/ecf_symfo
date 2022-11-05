# ecf_symfo
#Pour commencer 
cloner le répo : ouvrez votre terminal entrez la commande git clone git@github.com:Kiou59/ecf_symfo.git
toujours dans votre terminal : cd ecf_symfo 
puis 
composer require symfony/runtime

#instaler la bdd : à la racine du dossier ecf_symfo créez un fichier .env.local
copiez coller la ligne suivante et modifier les champ entre crochet
 DATABASE_URL="mysql://{db_user}:{db_password}@127.0.0.1:3306/{db_name*}?{serverVersion=5.7}&charset=utf8mb4"
//*inutile de créé une base de donné en amont nous allons utilisé un script pour la généré
dans un terminal dans le dossier ecf_symfo taper la commande : ./bin/dofilo.sh
cette commande lance un script qui crée la base de donnée et injecte les donnée.
Le projet est installé entrez la commande : symfony serve
Vous pouvez maintenant consulter le projet sur votre serveur local via l'adresse "https://127.0.0.1:8000/"

afin d'acceder aux donnée de test vous devez vous connecter avec le compte admin:
id : admin.example.com
mdp : 123
## Les requêtes

### Les utilisateurs

Requêtes de lecture :"https://127.0.0.1:8000/test/lecture/users"

- la liste complète de tous les utilisateurs (de la table `user`)
- les données de l'utilisateur dont l'id est `1`
- les données de l'utilisateur dont l'email est `foo.foo@example.com`
- les données des utilisateurs dont l'attribut `roles` contient le mot clé `ROLE_EMRUNTEUR`

### Les livres

Requêtes de lecture :"https://127.0.0.1:8000/test/lecture/livre"

- la liste complète de tous les livres
- les données du livre dont l'id est `1`
- la liste des livres dont le titre contient le mot clé `lorem`
- la liste des livres dont l'id de l'auteur est `2`
- la liste des livres dont le genre contient le mot clé `roman`

Requêtes de création :"https://127.0.0.1:8000/test/new/book"

- ajouter un nouveau livre
  - titre : Totum autem id externum
  - année d'édition : 2020
  - nombre de pages : 300
  - code ISBN : 9790412882714
  - auteur : Hugues Cartier (id `2`)
  - genre : science-fiction (id `6`)

Requêtes de mise à jour :"https://127.0.0.1:8000/test/edit/book"

- modifier le livre dont l'id est `2`
  - titre : Aperiendum est igitur
  - genre : roman d'aventure (id `5`)

Requêtes de suppression :"https://127.0.0.1:8000/test/remove/book"

- supprimer le livre dont l'id est `123`

### Les emprunteurs

Requêtes de lecture :"https://127.0.0.1:8000/test/lecture/emprunteur"

- la liste complète des emprunteurs
- les données de l'emprunteur dont l'id est `3`
- les données de l'emprunteur qui est relié au user dont l'id est `3`
- la liste des emprunteurs dont le nom ou le prénom contient le mot clé `foo`
- la liste des emprunteurs dont le téléphone contient le mot clé `1234`
- la liste des emprunteurs dont la date de création est antérieure au 01/03/2021 exclu (c-à-d strictement plus petit)
- la liste des emprunteurs inactifs (c-à-d dont l'attribut `actif` est égal à `false`)

### Les emprunts

Requêtes de lecture :"https://127.0.0.1:8000/test/lecture/emprunt"

- la liste des 10 derniers emprunts au niveau chronologique
- la liste des emprunts de l'emprunteur dont l'id est `2`
- la liste des emprunts du livre dont l'id est `3`
- la liste des emprunts qui ont été retournés avant le 01/01/2021
- la liste des emprunts qui n'ont pas encore été retournés (c-à-d dont la date de retour est nulle)
- les données de l'emprunt du livre dont l'id est `3` et qui n'a pas encore été retournés (c-à-d dont la date de retour est nulle)

Requêtes de création :"https://127.0.0.1:8000/test/new/emprunt"

- ajouter un nouvel emprunt
  - date d'emprunt : 01/12/2020 à 16h00
  - date de retour : aucune date
  - emprunteur : foo foo (id `1`)
  - livre : Lorem ipsum dolor sit amet (id `1`)

Requêtes de mise à jour :"https://127.0.0.1:8000/test/edit/emprunt"

- modifier l'emprunt dont l'id est `3`
  - date de retour : 01/05/2020 à 10h00

Requêtes de suppression :"https://127.0.0.1:8000/test/remove/emprunt"

- supprimer l'emprunt dont l'id est `42`





ecf symfony
