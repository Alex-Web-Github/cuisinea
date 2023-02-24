<?php


function getRecipeById(PDO $pdo, int $id)
{
    // Code ci-après pour prévenir les injections de requêtes SQL malveillantes (= "requête préparée").
    $query = $pdo->prepare("SELECT * FROM recipes WHERE id = :id");
    // Requête pré-paramétrée avec bindParam
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    return $recipe = $query->fetch();
}

// Affichage d'une image par défaut si aucune image fournie dans la BDD. Ici, le '|' est équivalent à 'OU'et permet de spécifier 2 types de paramètre : un STRING ou bien la valeur NULL
// Remarque: on ne stocke pas l'image en BDD (il faudrait faire autrement), seulement le chemin d'accès à l'image. 
function getRecipeImage(string|null $image)
{

    if ($image === null) {
        return _ASSETS_IMG_PATH_ . 'recipe_default.jpg';
    } else {
        return _RECIPES_IMG_PATH_ . $image;
    }
}

function getRecipes(PDO $pdo, int $limit = null)
// Le paramètre $limit devient optionnel car on lui donne une valeur par défaut = NULL pour récupérer toutes les recettes SAUF sur la page Accueil(index.php) où on en affichera que 3.
{
    // Notre requête pour récupérer toutes les recettes et avoir les dernières ajoutées en premier avec 'ORDER BY id DESC'.
    $sql = 'SELECT * FROM recipes ORDER BY id DESC';
    //Remarque: $sql = 'SELECT * FROM recipes ORDER BY RAND() DESC'; pour affichage aléatoire.
    if ($limit){
        //On vient concaténer le paramètre LIMIT à notre requête SQL si $limit est définit.
        $sql .= ' LIMIT :limit';
    }
    $query = $pdo->prepare($sql);

    if ($limit) {
        // Code ci-dessous pour prévenir les injections de requêtes SQL malveillantes comme précédemment (= "requête préparée").
        $query-> bindParam(':limit', $limit, PDO::PARAM_INT);
    }
    $query->execute();
    return $query->fetchALL();
}

// Fonction pour insérer une nouvelle recette depuis le formulaire de soumission
function saveRecipe(PDO $pdo, int $category, string $title, string $description, string $ingredients, string $instructions, string | null $image){
        //On utilise à nouveau le principe de Requête préparée (sécurité ++).
    $sql = 'INSERT INTO `recipes` (`id`, `category_id`, `title`, `description`, `ingredients`, `instructions`, `image`) VALUES (NULL, :category_id, :title, :description, :ingredients, :instructions, :image)';

    $query = $pdo->prepare($sql);
    $query-> bindParam(':category_id', $category, PDO::PARAM_INT);
    $query-> bindParam(':title', $title, PDO::PARAM_STR);
    $query-> bindParam(':description', $description, PDO::PARAM_STR);
    $query-> bindParam(':ingredients', $ingredients, PDO::PARAM_STR);
    $query-> bindParam(':instructions', $instructions, PDO::PARAM_STR);
    $query-> bindParam(':image', $image, PDO::PARAM_STR);

    return $query->execute();
}

