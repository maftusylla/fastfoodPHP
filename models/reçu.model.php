$genererRecu = function (int $idPaiement): array {
    global $recus, $trouverPaiementParId;
    $paiement = $trouverPaiementParId($idPaiement);
    $recu = [
        'id' => count($recus),
        'id_paiement' => $idPaiement,
        'montant' => $paiement['montant'] ?? 0,
        'date_recu' => date('Y-m-d H:i:s'),
    ];
    $recus[] = $recu;
    return $recu;
};