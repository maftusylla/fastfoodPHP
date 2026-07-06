<?php

$afficherVueConfirmation = function (int $idCommande): void {
    echo "\n=== COMMANDE ENREGISTREE ===\n";
    echo "Commande n{$idCommande} - Statut : En attente\n";
};
