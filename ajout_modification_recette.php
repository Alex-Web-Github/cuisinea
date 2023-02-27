<?php
require_once('templates/header.php');
require_once('lib/recipe.php');
require_once('lib/tools.php');
require_once('lib/category.php');

// On crée un tableau qui va recevoir les Erreurs et un autre pour les Messages d'erreurs pour gérer la bonne marche de l'enregistrement des Recettes.
// Potentiellement, on pourrait afficher plusieurs types d'erreurs suivant les champs du formulaire générant les erreurs.
// On initialise les variables.
$errors = [];
$messages = [];

$categories = getCategories($pdo);
//var_dump($categories);

// Test pour n'afficher le contenu $_POST qu'à la soumission du formulaire
// On aurait pu aussi utiliser $_SERVER dont la Request_Method passerait de de 'GET' à 'POST' en, cas de soumission du formulaire.
// "saveRecipe" correspondant à l'id du bouton de soumission en bas du formulaire.
if (isset($_POST['saveRecipe'])) {

    echo 'VAR_DUMP de $_FILES["file"] : <br>';
    var_dump($_FILES['file']);
    echo '<br>';

    // Si un fichier a été envoyé (envoi correct et tmp_name non vide)
    if(isset($_FILES['file']['tmp_name']) && $_FILES['file']['tmp_name'] !=''){
        // Méthode getImageSize renverra false si fichier pas une image.
        // nb: On peut aussi vérifier l'extension du fichier
        $checkImage = getImageSize($_FILES['file']['tmp_name']);
        
        if ($checkImage !== false){
            // Si c'est une image, on traite
            move_uploaded_file($_FILES['file']['tmp_name'], _RECIPES_IMG_PATH_.$_FILES['file']['name']);

        } else {
            // Sinon on affiche un message d'erreur
            $errors[] = 'Le fichier doit être une image';
        }
    }

    /*
    //Démarre la sauvegarde en BDD
    $res = saveRecipe($pdo, $_POST['category'], $_POST['title'], $_POST['description'], $_POST['ingredients'], $_POST['instructions'], NULL);

    if ($res) {
        $messages[] = 'La recette a bien été sauvegardée';
    } else {
        $errors[] = 'La recette n\'a pas été sauvegardée';
    }
    */

}

?>
<h1>Ajouter une recette</h1>
<?php 
    foreach ($messages as $message) {?>
        <div class="alert alert-success">
            <?= $message;?>
        </div>
    <?php
} ?>

<?php 
    // Le code suivant sera pratique pour gérer l'affichage de plusieurs messages d'erreurs (ie: tableau avec plusieurs messages d'erreurs).
    foreach ($errors as $error) {?>
        <div class="alert alert-success">
            <?= $error;?>
        </div>
    <?php
} ?>


<!-- Dans <form> ci-après, on ne spécifie pas "ACTION" car on va traiter le formulaire dans cette même page -->
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
            <?php foreach ($categories as $categorie){?>
                <option value="<?= $categorie['id']; ?>"><?= $categorie['name']; ?></option>
            <?php }?>  
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