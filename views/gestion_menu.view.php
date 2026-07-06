<?php

$afficherVueGestionMenu = function (array $plats): void {
    echo "\n=== CATALOGUE ===\n";
    foreach ($plats as $plat) {
        echo "{$plat['nom']} - {$plat['prix']} CFA - {$plat['description']}\n";
    }
};
