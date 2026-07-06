
$recupererLivreursParStatut = function (string $statut): array {
    global $livreurs;
    return array_values(array_filter($livreurs, function ($livreur) use ($statut) {
        return $livreur['statut'] === $statut;
    }));
};

$mettreAJourStatutLivreur = function (int $idLivreur, string $statut): bool {
    global $livreurs;
    foreach ($livreurs as $index => $livreur) {
        if ($livreur['id'] === $idLivreur) {
            $livreurs[$index]['statut'] = $statut;
            return true;
        }
    }
    return false;
};
