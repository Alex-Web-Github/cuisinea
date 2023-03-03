<?php
require_once('templates/header.php'); //appel de config.php et pdo.php
require_once('lib/user.php'); //appel de config.php et pdo.php

$errors = [];
$messages = [];

/* étape intermédiaire ci-dessous pour tester le formulaire et les messages d'erreurs
$users = [
    ['email' => 'abc@test.com', 'password' => '1234'],
    ['email' => 'test@test.com', 'password' => 'test'],
];
*/

// on vérifie que le formulaire a bien été soumis avec isset(...)
if (isset($_POST['loginUser'])) {
    $user = verifyUserLoginPassword($pdo, $_POST['email'], $_POST['password']);

    if ($user) {
        // On stocke ci-dessous que l'email du User dans la session.
        // On peut aussi stocker nom, prénom etc pour l'afficher et personnaliser ainsi l'affichage
        $_SESSION['user'] = ['email' => $user['email']];
        header('location: index.php');
    } else {
        $errors[] = 'Email ou MdP incorrect';
    }
} 
?>

<h1>Connexion</h1>

<?php foreach ($messages as $message) { ?>
    <div class="alert alert-success">
        <?= $message; ?>
    </div>
<?php } ?>

<?php foreach ($errors as $error) { ?>
    <div class="alert alert-success">
        <?= $error; ?>
    </div>
<?php } ?>

<form action="" method="POST">
    <div class="mb-3">
        <label class="for-label" for="email">Votre E-mail</label>
        <input class="form-control" type="email" name="email" id="email">
    </div>
    <div class="mb-3">
        <label class="for-label" for="password">Votre Mot de Passe</label>
        <input class="form-control" type="password" name="password" id="password">
    </div>

    <input type="submit" class="btn btn-primary" value="Connexion" name="loginUser" id="loginUser">

</form>


<?php require_once('templates/footer.php'); ?>