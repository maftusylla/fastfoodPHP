$traiterAssignationLivreur = function (int $idCommande, int $idLivreur): array {
    global $mettreAJourStatut, $mettreAJourStatutLivreur, $creerNotification, $rechercherCommandeParId;

    $commande = $rechercherCommandeParId($idCommande);
    if ($commande === null) {
        return ['succes' => false, 'erreur' => "Commande introuvable."];
    }
    if ($commande['statut'] !== 'En préparation') {
        return ['succes' => false, 'erreur' => "Cette commande n'est pas prête à être expédiée."];
    }

    // RG4 : trois écritures distinctes
    $mettreAJourStatut($idCommande, "En livraison");
    $mettreAJourStatutLivreur($idLivreur, "Occupé");
    $creerNotification($idLivreur, "Nouvelle commande a livrer : n{$idCommande}");

    return ['succes' => true];
};