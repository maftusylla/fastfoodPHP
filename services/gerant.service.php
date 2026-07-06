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

    // RG3
    $mettreAJourStatut($idCommande, "En préparation");

    // RG4
    $creerNotification($commande['id_client'] ?? 0, "Commande n{$idCommande} en préparation");

    return ['succes' => true];
};
