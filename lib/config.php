<?php
// Création d'une constante pour définir le chemin vers le répertoire de nos images de recettes
define('_RECIPES_IMG_PATH_', '/uploads/recipes/');
define('_ASSETS_IMG_PATH_', 'assets/images/');
define ('HOME_RECIPES_LIMIT', 3);

// l'URL étant unique, c'est plus logique de la placer en tant que Clé ($key) qui est forcément unique par nature
$mainMenu = [
    'index.php' => 'Accueil',
    'recettes.php' => 'Nos recettes',
    'ajout_modification_recette.php' => 'Ajout/modif.recette',
];
