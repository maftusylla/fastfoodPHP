
$rechercherCommandeParId = function (int $idCommande): ?array {
    global $commandes;
    foreach ($commandes as $commande) {
        if ($commande['id'] === $idCommande) {
            return $commande;
        }
    }
    return null;
};

$mettreAJourStatut = function (int $idCommande, string $statut): bool {
    global $commandes;
    foreach ($commandes as $index => $commande) {
        if ($commande['id'] === $idCommande) {
            $commandes[$index]['statut'] = $statut;
            return true;
        }
    }
    return false;
};