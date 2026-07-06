$listerCommandesATraiter = function (): array {
    global $recupererCommandesParStatut;
    return $recupererCommandesParStatut("En préparation");
};


$assignerLivreur = function (): void {
    global $saisie, $rechercherCommandeParId, $recupererLivreursParStatut,
           $traiterAssignationLivreur, $afficherMessage,
           $afficherVueAssignation, $afficherVueSucces;

    $idCommande = (int) $saisie("ID de la commande a expedier : ");
    $commande = $rechercherCommandeParId($idCommande);

    $livreursDisponibles = $recupererLivreursParStatut("Disponible");
    $afficherVueAssignation($commande, $livreursDisponibles);

    $idLivreur = (int) $saisie("ID du livreur a assigner : ");

    $resultat = $traiterAssignationLivreur($idCommande, $idLivreur);

    if (!$resultat['succes']) {
        $afficherMessage($resultat['erreur']);
        return;
    }

    $afficherVueSucces("Livreur assigné avec succès");
};
