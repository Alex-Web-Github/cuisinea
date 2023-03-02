<?php
// Voici des petites fonctions réutilisables à plusieurs endroits si besoin

//explode() retourne un tableau de chaînes de caractères, chacune d'elle étant une sous-chaîne du paramètre string extraite en utilisant le séparateur separator.
//Nos ingrédients sont stockés sous forme d'un String avec saut de ligne (d'où le PHP_EOL en paramètre de EXPLODE). On utilise la fct Explode pour différencier chaque ingrédient et l'afficher sous forme d'une liste en Front-End.
function linesToArray(string $string)
{
    return explode(PHP_EOL, $string);
}

// Fonction pour uniformiser les slugs (trouvé sur le web)et "cleaner" les noms de fichiers
function slugify($text, string $divider = '-')
{
    // Replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

    // Transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // Remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // Trim
    $text = trim($text, $divider);

    // Remove duplicate divider
    $text = preg_replace('~-+~', $divider, $text);

    // Lowercase
    $text = strtolower($text);

    // Check if it is empty
    if (empty($text)) { return 'n-a'; }

    // Return result
    return $text;
}
