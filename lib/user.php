<?php

function addUser(PDO $pdo, string $first_name, string $last_name, string $email, string $password)
{
    $sql = "INSERT INTO `users`(`first_name`, `last_name`, `email`, `password`, `role`) VALUES (:first_name, :last_name, :email, :password, :role);";

    $query = $pdo->prepare($sql);

    $role = 'subscriber';
    // "PASSWORD_DEFAULT" est l'algo. par défaut de PHP le plus sécurisé (évolutif dans le temps)-> voir la doc sur PHP.net. Même un ADMIN n'a pas accès aux mots de passe dans la BDD
    $password = password_hash($password, PASSWORD_DEFAULT);

    $query->bindParam(':first_name', $first_name, PDO::PARAM_STR);
    $query->bindParam(':last_name', $last_name, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->bindParam(':role', $role, PDO::PARAM_STR);

    return $query->execute();
}

//Vérifier si la pezrsonne est déjà inscrite ou pas
function verifyUserLoginPassword(PDO $pdo, string $email, string $password)
{
    // On sélectionne le $user dont l'email est celui envoyé par le formulaire : si son password correspond à celui envoyé c'est OK sinon -> message d'erreur.
    $query = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    // Requête pré-paramétrée avec bindParam
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch();

    // la fonction "password_verify" ci-dessous permet de vérifier le mot de passe rentré avec celui "hashé" en BDD
    if ($user && password_verify($password, $user['password'])) {
        return $user;
    } else {
        // En terme de sécu, c'est mieux de ne pas préciser si c'est l'email ou le mdp qui est faux, l'autre étant vrai ...
        return false;
    }
}
