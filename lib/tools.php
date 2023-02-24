<?php
// des petites fonctions réutilisables à plusieurs endroits si besoin

//explode() retourne un tableau de chaînes de caractères, chacune d'elle étant une sous-chaîne du paramètre string extraite en utilisant le séparateur separator.
//Nos ingrédients sont stockés sous forme d'un String avec saut de ligne (d'où le PHP_EOL en paramètre de EXPLODE). On utilise la fct Explode pour différencier chaque ingrédient et l'afficher sous forme d'une liste en Front-End.
function linesToArray(string $string)
{
    return explode(PHP_EOL, $string);
}


