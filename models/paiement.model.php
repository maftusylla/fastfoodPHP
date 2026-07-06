$enregistrerPaiement = function (int $idCommande, float $montant, string $modePaiement, string $statut): int {
    global $paiements;
    $idPaiement = count($paiements);
    $paiements[] = [
        'id' => $idPaiement,
        'id_commande' => $idCommande,
        'date_paiement' => date('Y-m-d H:i:s'),
        'montant' => $montant,
        'mode_paiement' => $modePaiement,
        'statut' => $statut,
    ];
    return $idPaiement;
};

$trouverPaiementParId = function (int $idPaiement): ?array {
    global $paiements;
    foreach ($paiements as $paiement) {
        if ($paiement['id'] === $idPaiement) {
            return $paiement;
        }
    }
    return null;
};
