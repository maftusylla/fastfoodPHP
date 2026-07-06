<?php

$afficherVueAssignation = function (array $commande, array $livreurs): void {
    echo "\n=== ASSIGNATION LIVREUR ===\n";
    echo "Commande n{$commande['id']} - Statut : En preparation\n";
    echo "Livreurs disponibles :\n";
    foreach ($livreurs as $livreur) {
        echo "{$livreur['id']}-{$livreur['nom']}\n";
    }
};
