INSTALLATION LOCALE DE L'APPLICATION :

Installation des dépendances :

composer install
npm i

!!!MISE EN PLACE DE LA BASE DE DONNEES!!!!!

dans le fichier .env à la racine, modifier la variable DATABASE_URL pour mettre le nom de votre base de données et vos identifiants de connexion :
DATABASE_URL="mysql://username:password@localhost:80/database?serverVersion=5.7"


Déploiement de la base de données :
php bin/console doctrine:migration:migrate
php bin/console doctrine:fixtures:load




Lancement de l'application :
symfony server:start -no-tls

http://localhost:8000/


COMPTE ADMINISTRATEUR (il faut un compte pour passer commande) :
username : admin@gmail.com
password : admin

(possibilité de se créer un compte user, celui-ci pourra passer commande mais n'aura pas accès à l'espace administrateur)


Informations :
la navigation se fait à l'aide de pageController et des fichiers twig dans le dossier page, sinon chaque fonctionnalité à son controller et son dossier twig.
Les routes sont stockés dans le fichier routes.yml.