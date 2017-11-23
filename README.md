# Projet 6 - Site communautaire SnowTricks / Project 6 - SnowTricks website

Ce site a été réalisé pour le projet 6 du parcours Développeur d'application - PHP / Symfony d'OpenClassrooms.
J'ai utilisé comme base le thème Modern Business de StartBoostrap et Symfony Standard Edition.

Tous les éléments préparatoires de ce projet (diagrammes, wireframes et maquette) sont dans le dossiers docs.

This website has been made for the sixth project of OpenClassrooms path Application Developer - PHP / Symfony.
I used and modified the theme Modern Business by StartBoostrap and Symfony Standard Edition.

In the docs folder, you can find the groundwork of this project (diagrams, wireframes and mock-up).

## Installation

Clonez le repository GitHub et tapez les commandes suivantes :
1. Entrez vos identifiants de connexion à la base de données dans app/config/parameters.yml
1. composer install
1. php bin/console doctrine:database:create
1. php bin/console doctrine:schema:create
1. php bin/console hautelook:fixtures:load (si vous voulez utiliser les fixtures)
1. php bin/console assets:install --symlink web

Clone the GitHub repository and execute the following commands :
1. Enter your database settings in app/config/parameters.yml
1. composer install
1. php bin/console doctrine:database:create
1. php bin/console doctrine:schema:create
1. php bin/console hautelook:fixtures:load (if you want to use fixtures)
1. php bin/console assets:install --symlink web

## Symfony Standard Edition

Welcome to the Symfony Standard Edition - a fully-functional Symfony
application that you can use as the skeleton for your new applications.

For details on how to download and get started with Symfony, see the
[Installation](https://symfony.com/doc/3.3/setup.html) chapter of the Symfony Documentation.

## Original : [Start Bootstrap - Modern Business](https://startbootstrap.com/template-overviews/modern-business/)

[Modern Business](http://startbootstrap.com/template-overviews/modern-business/) is a multipurpose, full website template for [Bootstrap](http://getbootstrap.com/) created by [Start Bootstrap](http://startbootstrap.com/). This template includes 17 unique HTML pages and a working PHP contact form.

## About Start Bootstrap

Start Bootstrap is an open source library of free Bootstrap templates and themes. All of the free templates and themes on Start Bootstrap are released under the MIT license, which means you can use them for any purpose, even for commercial projects.

* https://startbootstrap.com
* https://twitter.com/SBootstrap

Start Bootstrap was created by and is maintained by **[David Miller](http://davidmiller.io/)**, Owner of [Blackrock Digital](http://blackrockdigital.io/).

* http://davidmiller.io
* https://twitter.com/davidmillerskt
* https://github.com/davidtmiller

Start Bootstrap is based on the [Bootstrap](http://getbootstrap.com/) framework created by [Mark Otto](https://twitter.com/mdo) and [Jacob Thorton](https://twitter.com/fat).