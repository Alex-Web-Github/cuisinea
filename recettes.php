<?php
require_once('templates/header.php');
require_once('lib/recipe.php');

$recipes = getRecipes($pdo);
// Rappel : l'appel à PDO a été défini avant dans le fichier header.php, donc pas besoin de Require/Require_once ici.

?>

<div class="row flex-lg-row-reverse align-items-center g-5 py-5">
    <h1>Liste des recettes</h1>
</div>
<div class="row">
    <?php foreach ($recipes as $key => $recipe) {
        include('templates/recipe_partial.php');
        //on pourrait aussi utiliser 'require'
    }; ?>
</div>

<?php require_once('templates/footer.php'); ?>