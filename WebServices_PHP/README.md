WebServices_PHP



Commandes pour init le serveur dans dans le dossier webservices_php_client : 

composer install;
npm i;
npm run dev;
créer base de données "mi07" dans phpmyadmin, changer .env URL;
php bin/console doctrine:migrations:migrate;
php bin/console doctrine:fixtures:load;


Soap Entities sont dans : WebServices_PHP/Src/Soap
Soap Controller sont dans : WebServices_PHP/src/controller/Soap/
Soap Client sont dans : WebServices_PHP_Client/