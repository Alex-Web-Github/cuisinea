<?php
require_once('templates/header.php'); //appel de config.php et pdo.php
require_once('lib/user.php');

$errors = [];
$messages = [];

// on vérifie que le formulaire a bien été soumis avec isset(...)
if (isset($_POST['addUser'])) {
    $res = addUser($pdo, $_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password']);

    if ($res) {
        $messages[] = 'Merci pour votre inscription !';
    } else {
        $errors[] = 'Une erreur s\'est produite lors de votre inscription';
    }
}
?>

<h1>Inscription</h1>
<?php
foreach ($messages as $message) { ?>
    <div class="alert alert-success">
        <?= $message; ?>
    </div>
<?php } ?>

<?php
foreach ($errors as $error) { ?>
    <div class="alert alert-success">
        <?= $error; ?>
    </div>
<?php } ?>

<form action="" method="POST">
    <div class="mb-3">
        <label class="for-label" for="first_name">Prénom</label>
        <input class="form-control" type="text" name="first_name" id="first_name">
    </div>
    <div class="mb-3">
        <label class="for-label" for="last_name">Nom</label>
        <input class="form-control" type="text" name="last_name" id="last_name">
    </div>
    <div class="mb-3">
        <label class="for-label" for="email">Votre E-mail</label>
        <input class="form-control" type="email" name="email" id="email">
    </div>
    <div class="mb-3">
        <label class="for-label" for="password">Votre Mot de Passe</label>
        <input class="form-control" type="password" name="password" id="password">
    </div>
    <input type="submit" class="btn btn-primary" value="m'enregistrer" name="addUser" id="addUser">
</form>

<?php require_once('templates/footer.php'); ?>