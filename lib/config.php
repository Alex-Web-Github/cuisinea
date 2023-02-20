<?php
// Création d'une constante pour définir le chemin vers le répertoire de nos images de recettes
define('_RECIPES_IMG_PATH_', '/uploads/recipes/');

// l'URL étant unique, c'est plus logique de la placer en tant que Clé ($key) qui est forcément unique par nature
$mainMenu = [
    'index.php' => 'Accueil',
    'recettes.php' => 'Nos recettes',
];
