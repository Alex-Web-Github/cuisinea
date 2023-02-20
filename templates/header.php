<?php
require_once('lib/config.php');

$currentPage = basename($_SERVER["SCRIPT_NAME"]);

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cuisinea, recettes faciles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/override-bootstrap.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                <img src="/assets/images/logo-cuisinea-horizontal.jpg" style="width: 200px;" alt="logo cuisinea">
            </a>
            <ul class="nav nav-pills col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <?php foreach ($mainMenu as $key => $value){ ?>
                    <li class="nav-item"><a href="<?= $key; ?>" class="nav-link <?php if ($currentPage === $key){
                echo 'active';} ?>"><?= $value; ?></a></li>
                <?php }; ?>
            </ul>

            <div class="col-md-3 text-end">
                <button type="button" class="btn btn-outline-primary me-2">Login</button>
                <button type="button" class="btn btn-primary">Sign-up</button>
            </div>
        </header>
