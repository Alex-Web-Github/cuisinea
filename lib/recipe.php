<?php


function getRecipeById(PDO $pdo, int $id)
{
    // Code ci-après pour prévenir les injection de requêtes SQL malveillantes
    $query = $pdo->prepare("SELECT * FROM recipes WHERE id = :id");
    // Requête pré-paramétrée avec bindParam
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    return $recipe = $query->fetch();
}

// Affichage d'une image par défaut si aucune image fournie dans la BDD. Ici, le '|' est équivalent à 'OU'et permet de spécifier 2 types de paramètre : un STRING ou bien la valeur NULL
function getRecipeImage(string|null $image)
{

    if ($image === null) {
        return _ASSETS_IMG_PATH_ .'recipe_default.jpg';
    } else {
        return _RECIPES_IMG_PATH_ .$image;
    }
}
