<?php
require_once('templates/header.php');
require_once('lib/recipe.php');
$recipes = getRecipes($pdo, HOME_RECIPES_LIMIT);
?>

<div class="row flex-lg-row-reverse align-items-center g-5 py-5">
    <div class="col-10 col-sm-8 col-lg-6">
        <img src="/assets/images/logo-cuisinea.jpg" class="d-block mx-lg-auto img-fluid" alt="logo cuisinea" loading="lazy">
    </div>
    <div class="col-lg-6">
        <h1 class="display-5 fw-bold lh-1 mb-3">Cuisinea - Recettes de cuisine</h1>
        <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum temporibus quod facilis expedita dicta labore, laboriosam vero cumque repellat ducimus voluptate quis magni obcaecati unde, beatae voluptates odio animi! Est.
        </p>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
            <a href="recettes.php" class="btn btn-primary">Voir nos recettes</a>
        </div>
    </div>
</div>

<div class="row">
    <?php foreach ($recipes as $key => $recipe) {
        require('templates/recipe_partial.php');
        // Pour n'afficher que 3 recettes, il vaut mieux modifier la reqête mySQl car sinon on appel est très grand tableau pour au final n'utiliser que les 3 premiers éléments (ça ne serait pas optimum)
    }; ?>
</div>

<?php require_once('templates/footer.php'); ?>