<?php

$afficherVueRecu = function (array $recu, int $idCommande): void {
    echo "\n=== PAIEMENT CONFIRME ===\n";
    echo "Commande n{$idCommande} - Statut : Payee\n";
    echo "Montant paye : {$recu['montant']} CFA\n";
    echo "Recu n{$recu['id']}\n";
};
