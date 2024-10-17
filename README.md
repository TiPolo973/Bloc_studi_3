<h1>Jeux Olympic Ticket</h1>

Description
Ce projet est une application de réservation de tickets pour les Jeux Olympiques, construite avec
Symfony. L'application permet aux utilisateurs de créer des comptes, de réserver des tickets en toute
sécurité et aux administrateurs de gérer les ventes. La solution comprend également l'intégration
avec des services de paiement comme Stripe, une gestion des offres promotionnelles, et un espace 
administrateur.

<strong>Fonctionnalités</strong>
  - Gestion des utilisateurs (inscription, connexion, rôles)
  - Réservation sécurisée de tickets
  - Génération de clés de sécurité pour les billets
  - Espace administrateur pour la gestion des ventes
  - Intégration avec Stripe pour les paiements
  - Gestion des paniers et offres promotionnelles

<strong>Prérequis</strong>
  - PHP 8.1 ou supérieur
  - Composer
  - Node.js et npm
  - Symfony CLI
  - MariaDB

Installation
  - Cloner le dépot

git clone https://github.com/TiPolo973/Bloc_studi_3 <br/>
cd Bloc_studi_3

  - Installer les dépendances PHP <br/>

composer install <br/>
npm install

  - Configurer les variable d'environnement <br/>
  
Crée un fichier .env.local
  - Crée la base de données <br/>
  
symfony console doctrine:database:create <br/>
symfony console doctrine:migrations:migrate

  - Lancer le serveur <br/>
  
symfony server:start

<strong>Technologies</strong>
  - Symfony 6.x
  - MariaDB via heroku
  - Stripe pour les paiements
