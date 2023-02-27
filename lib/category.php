<?php
function getCategories(PDO $pdo)
{
    // Notre requête pour récupérer toutes les catégories de la BDD
    $sql = 'SELECT * FROM categories';
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetchALL();
}
