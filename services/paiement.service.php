<?php
require_once(__DIR__ . "/../model/commande.model.php");
require_once(__DIR__ . "/../model/paiement.model.php");
require_once(__DIR__ . "/../model/recu.model.php");


$transmettrePaiement = function (int $idCommande, float $montant, array $infosCarte): bool {
    return !empty($infosCarte['numero']);
};

$traiterPaiement = function (int $idCommande, array $infosCarte): array {
    global $rechercherCommandeParId, $transmettrePaiement, $mettreAJourStatut,
           $enregistrerPaiement, $genererRecu;

    $commande = $rechercherCommandeParId($idCommande);
    if ($commande === null) {
        return ['succes' => false, 'erreur' => "Commande introuvable."];
    }
    if ($commande['statut'] !== 'En attente') {
        return ['succes' => false, 'erreur' => "Cette commande n'est pas en attente de paiement."];
    }

    $confirmation = $transmettrePaiement($idCommande, $commande['montant_total'], $infosCarte);
    if (!$confirmation) {
        $enregistrerPaiement($idCommande, $commande['montant_total'], 'Carte bancaire', 'Refusée');
        return ['succes' => false, 'erreur' => "Paiement refusé par la banque."];
    }

    $idPaiement = $enregistrerPaiement($idCommande, $commande['montant_total'], 'Carte bancaire', 'Réussie');
    $mettreAJourStatut($idCommande, "Payée");
    $recu = $genererRecu($idPaiement);

    return ['succes' => true, 'recu' => $recu];
};
