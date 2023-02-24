<?php
require_once('templates/header.php');
require_once('lib/recipe.php');
require_once('lib/tools.php');

// Dans <form> on ne spécifie pas "ACTION" car on va traiter le formuliare dans cette même page

// Test pour n'afficher le contenu $_POST qu'à la soumission du formulaire
// On aurait pu aussi utiliser $_SERVER dont la Request_Method passerait de de 'GET' à 'POST' en, cas de soumission du formulaire.
// "saveRecipe" correspondant à l'id du bouton de soumission en bas du formulaire.
if (isset($_POST['saveRecipe'])) {
    $res = saveRecipe($pdo, $_POST['category'], $_POST['title'], $_POST['description'], $_POST['ingredients'], $_POST['instructions'], NULL);

    // Test pour vérification s'est bien passée : TRUE -> OK
    var_dump($res);
}

?>

<form action="" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label class="for-label" for="title">Titre</label>
        <input class="form-control" type="text" name="title" id="title">
    </div>
    <div class="mb-3">
        <label class="form-label" for="description">Description</label>
        <textarea class="form-control" name="description" id="description" cols="30" rows="5"></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label" for="ingredients">Ingrédients</label>
        <textarea class="form-control" name="ingredients" id="ingredients" cols="30" rows="5"></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label" for="instructions">Instructions</label>
        <textarea class="form-control" name="instructions" id="instructions" cols="30" rows="5"></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label" for="category">Catégorie</label>
        <select class="form-select" name="category" id="category" cols="30" rows="5">
            <option value="1">Entrée</option>
            <option value="2">Plat</option>
            <option value="3">Dessert</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label" for="file">Image</label>
        <input class="form-control" type="file" name="file" id="file">
    </div>


    <input type="submit" class="btn btn-primary" value="Enregistrer" name="saveRecipe" id="saveRecipe">


</form>

<?php
require_once('templates/footer.php');
?>