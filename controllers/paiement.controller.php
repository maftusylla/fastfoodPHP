<?php
require_once(__DIR__ . "/../models/commande.model.php");
require_once(__DIR__ . "/../services/paiement.service.php");
require_once(__DIR__ . "/../utils/view.php");
require_once(__DIR__ . "/../views/paiement.view.php");
require_once(__DIR__ . "/../views/recu.view.php");

$choisirPaiement = function (): void {
    global $commandes, $utilisateurConnecte, $saisie, $rechercherCommandeParId,
           $traiterPaiement, $afficherMessage, $afficherVuePaiement, $afficherVueRecu;

    $idClient = $utilisateurConnecte['id'] ?? 0;
    $commandesEnAttente = array_values(array_filter($commandes, function ($c) use ($idClient) {
        return $c['id_client'] === $idClient && $c['statut'] === 'En attente';
    }));

    if (empty($commandesEnAttente)) {
        $afficherMessage("Aucune commande en attente de paiement.");
        return;
    }

    echo "\n=== COMMANDES EN ATTENTE ===\n";
    foreach ($commandesEnAttente as $commande) {
        echo "{$commande['id']} - {$commande['montant_total']} CFA\n";
    }

    $idCommande = (int) $saisie("ID de la commande a payer : ");
    $commande = $rechercherCommandeParId($idCommande);

    $afficherVuePaiement($commande);
    $numeroCarte = $saisie("Numero de carte : ");
    $expiration = $saisie("Date d'expiration : ");
    $cvv = $saisie("CVV : ");
    $infosCarte = ['numero' => $numeroCarte, 'expiration' => $expiration, 'cvv' => $cvv];

    $resultat = $traiterPaiement($idCommande, $infosCarte);

    if (!$resultat['succes']) {
        $afficherMessage($resultat['erreur']);
        return;
    }

    $afficherVueRecu($resultat['recu'], $idCommande);
};
