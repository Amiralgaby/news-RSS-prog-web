Site de news automatisé par lecture RSS
---

Un projet de programmation web côté serveur
L'objectif est de réalisé un site qui résume des news de plusieurs site grâce aux flux RSS.

Les admins peuvent ajouter de nouveaux flux mais aussi les supprimer et de configurer le nombre maxi de news sur le site.

Indiquation de l'heure de la news, du site référencé, du titre, une description. le titre est un lien HTML.

Auteurs
---
* Erwan Soulier
* Gabriel Theuws

-------

Erwan à réalisé :

* Le FrontController
* La base de données (sa structure)
* Les fonctions de base des Gateway Article et Flux
* La classe AdminGateway.php
* La classe Modele.php
* La structure du site

---------

Gabriel a réalisé :

* Le choix de news à afficher par page
* L'implémentation de l'Autoload.php et de Connection.php
* Le parsseur XML
* La suppresssion de flux
* La base du site (en fonctionnel), la Validation, le Nettoyeur
* L'implémentation des mots de passe hashés

* Commun

--------

Réalisé en commun :

* Les Controllers

* Les Gateways

* L'affichage

* Les validations et nettoyages des variables 