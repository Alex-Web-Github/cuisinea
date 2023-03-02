<?php
function getCategories(PDO $pdo)
{
    // Notre requête en BDD pour récupérer toutes les catégories de notre BDD
    $sql = 'SELECT * FROM categories';
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetchALL();
}
