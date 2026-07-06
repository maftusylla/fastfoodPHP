<?php
// Scénario 1 : affichage du menu (vue_menu.php)

$afficherVueMenu = function (array $plats): void {
    echo "\n MENU \n";
    foreach ($plats as $plat) {
        $dispo = $plat['stock'] > 0 ? "" : " (indisponible)";
        echo "{$plat['id']}-{$plat['nom']} - {$plat['prix']} CFA{$dispo}\n";
        echo "   {$plat['description']}\n";
    }
};
