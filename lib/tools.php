<?php
// des petites fonctions réutilisables à plusieurs endroits si besoin

//explode() retourne un tableau de chaînes de caractères, chacune d'elle étant une sous-chaîne du paramètre string extraite en utilisant le séparateur separator.
function linesToArray(string $string)
{
    return explode(PHP_EOL, $string);
}


