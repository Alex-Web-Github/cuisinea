<?php

// Connexion entre PHP et la BDD
// On aurait pu aussi l'inclure aussi dans le header.php
$pdo = new PDO('mysql:dbname=studi_cuisinea;host=localhost;charset=utf8mb4', 'root', '');
