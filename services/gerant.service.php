<?php
require_once(__DIR__ . "/../models/commande.model.php");
require_once(__DIR__ . "/../models/livreur.model.php");
require_once(__DIR__ . "/../models/notification.model.php");

$traiterValidationCommande = function (int $idCommande): array {
    global $mettreAJourStatut, $rechercherCommandeParId, $creerNotification;

    $commande = $rechercherCommandeParId($idCommande);
    if ($commande === null) {
        return ['succes' => false, 'erreur' => "Commande introuvable."];
    }
    if ($commande['statut'] !== 'Payée') {
        return ['succes' => false, 'erreur' => "Cette commande n'est pas payée."];
    }

    $mettreAJourStatut($idCommande, "En préparation");

    $creerNotification($commande['id_client'] ?? 0, "Commande n{$idCommande} en préparation");

    return ['succes' => true];
};

$traiterAssignationLivreur = function (int $idCommande, int $idLivreur): array {
    global $mettreAJourStatut, $mettreAJourStatutLivreur, $creerNotification, $rechercherCommandeParId;

    $commande = $rechercherCommandeParId($idCommande);
    if ($commande === null) {
        return ['succes' => false, 'erreur' => "Commande introuvable."];
    }
    if ($commande['statut'] !== 'En préparation') {
        return ['succes' => false, 'erreur' => "Cette commande n'est pas prête à être expédiée."];
    }

    $mettreAJourStatut($idCommande, "En livraison");
    $mettreAJourStatutLivreur($idLivreur, "Occupé");
    $creerNotification($idLivreur, "Nouvelle commande a livrer : n{$idCommande}");

    return ['succes' => true];
};
