$recupererCommandesParStatut = function (string $statut): array {
    global $commandes;
    return array_values(array_filter($commandes, function ($commande) use ($statut) {
        return $commande['statut'] === $statut;
    }));
};
