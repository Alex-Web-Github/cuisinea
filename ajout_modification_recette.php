<?php
if(!isset($_SESSION['user'])){
    // l'utilisateur n'est pas inscrit, on va le rediriger vers la page 'login.php'
    header('location: login.php');

} else {


}

require_once('templates/header.php');
require_once('lib/recipe.php');
require_once('lib/tools.php');
require_once('lib/category.php');

// On crée un tableau qui va recevoir les Erreurs et un autre pour les Messages d'erreurs pour gérer la bonne marche de l'enregistrement des Recettes.
// Potentiellement, on pourrait afficher plusieurs types d'erreurs suivant les champs du formulaire générant les erreurs.
// On initialise les variables comme des tableaux vides.
$errors = [];
$messages = [];
$recipe = [
    'title' => '',
    'description' => '',
    'ingredients' => '',
    'instructions' => '',
    'category_id' => '',
];


$categories = getCategories($pdo);
//var_dump($categories);

// Test pour n'afficher le contenu $_POST qu'à la soumission du formulaire
// On aurait pu aussi utiliser $_SERVER dont la Request_Method passerait de de 'GET' à 'POST' en, cas de soumission du formulaire.
// "saveRecipe" correspondant à l'id du bouton de soumission en bas du formulaire.
if (isset($_POST['saveRecipe'])) {
    // on initialise la variable à 'null' au cas où aucune photo n'est fournie
    //Cela évite les erreurs php
    $fileName = null;

    // Si un fichier a été envoyé (envoi correct et tmp_name non vide)
    if(isset($_FILES['file']['tmp_name']) && $_FILES['file']['tmp_name'] !=''){
        // Méthode getImageSize renverra false si fichier pas une image.
        // nb: On peut aussi vérifier l'extension du fichier
        $checkImage = getImageSize($_FILES['file']['tmp_name']);
        
        if ($checkImage !== false){
            // Si c'est une image, on traite le déplacement du fichier uploadé
            // uniqid() : fonction native PHP pour générer des ID uniques
            // Utile pour éviter l'écrasement de fichier si plusieurs personnes utilisent le même non de fichier de photo.
            // Fonction slugify -> voir 'tools.php' to "clean file_name"
            $fileName = uniqid().'-'.slugify($_FILES['file']['name']);

            move_uploaded_file($_FILES['file']['tmp_name'], _RECIPES_IMG_PATH_.$fileName);

        } else {
            // Sinon on affiche un message d'erreur
            $errors[] = 'Le fichier doit être une image';
        }
    }

    // Si pas de message d'erreur (ie: !$errors = TRUE) alors on lance la sauvegarde
    if (!$errors){
        //Démarre la sauvegarde en BDD
        //On ne sauvegarde pas l'image en BDD, seulement le chemin vers cette image qui est stockée physiquement sur le serveur
        $res = saveRecipe($pdo, $_POST['category'], $_POST['title'], $_POST['description'], $_POST['ingredients'], $_POST['instructions'], $fileName);

            if ($res) {
                $messages[] = 'La recette a bien été sauvegardée';
            } else {
                $errors[] = 'La recette n\'a pas été sauvegardée';
            }
    }

    // Tableau permettant de garder les renseignements du formulaire à la soumission, même si il y a une erreur -> évite de tout rentrer une nouvelle fois dans le formulaire au rechargement de la page
    $recipe = [
        'title' => $_POST['title'],
        'description' => $_POST['description'],
        'ingredients' => $_POST['ingredients'],
        'instructions' => $_POST['instructions'],
        'category_id' => $_POST['category'],
    ];

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
        <input class="form-control" type="text" name="title" id="title" value="<?=$recipe['title']; ?>">
    </div>
    <div class="mb-3">
        <label class="form-label" for="description">Description</label>
        <textarea class="form-control" name="description" id="description" cols="30" rows="5"><?=$recipe['description'];?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label" for="ingredients">Ingrédients</label>
        <textarea class="form-control" name="ingredients" id="ingredients" cols="30" rows="5"><?=$recipe['ingredients'];?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label" for="instructions">Instructions</label>
        <textarea class="form-control" name="instructions" id="instructions" cols="30" rows="5"><?=$recipe['instructions'];?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label" for="category">Catégorie</label>
        <select class="form-select" name="category" id="category" cols="30" rows="5"> 
            <?php foreach ($categories as $categorie){?>
                <option value="<?= $categorie['id'];?>"  
                    <?php 
                    // code pour conserver le choix du plat en cas d'erreur sur le fichier
                    if($recipe['category_id'] == $categorie['id']) {echo 'selected="selected"';} ?>>
                    <?= $categorie['name'];?>
                </option>
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