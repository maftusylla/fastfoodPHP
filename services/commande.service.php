<?php
require_once(__DIR__ . "/../models/plat.model.php");
require_once(__DIR__ . "/../models/commande.model.php");
require_once(__DIR__ . "/../models/panier.model.php");
require_once(__DIR__ . "/../utils/commande.validator.php");


$calculerMontantTotal = function (array $lignesPanier): float {
    global $rechercherPlatParId;
    $total = 0;
    foreach ($lignesPanier as $ligne) {
        $plat = $rechercherPlatParId($ligne['id_plat']);
        if ($plat !== null) {
            $total += $plat['prix'] * $ligne['quantite'];
        }
    }
    return $total;
};


$construireLignesCommande = function (array $lignesPanier): array {
    global $rechercherPlatParId;
    $lignesCommande = [];
    foreach ($lignesPanier as $ligne) {
        $plat = $rechercherPlatParId($ligne['id_plat']);
        if ($plat !== null) {
            $lignesCommande[] = [
                'id_plat' => $ligne['id_plat'],
                'quantite' => $ligne['quantite'],
                'prix_unitaire' => $plat['prix'],
            ];
        }
    }
    return $lignesCommande;
};


$traiterPasserCommande = function (int $idClient): array {
    global $verifierDisponibilite, $calculerMontantTotal, $construireLignesCommande,
           $enregistrerCommande, $obtenirLignesPanier, $viderPanier;

    $lignesPanier = $obtenirLignesPanier($idClient);

    if (empty($lignesPanier)) {
        return ['succes' => false, 'erreur' => "Le panier est vide."];
    }

    if (!$verifierDisponibilite($lignesPanier)) {
        return ['succes' => false, 'erreur' => "Un ou plusieurs plats du panier ne sont plus disponibles."];
    }

    $montantTotal = $calculerMontantTotal($lignesPanier);
    $lignesCommande = $construireLignesCommande($lignesPanier);

    $idCommande = $enregistrerCommande($idClient, $lignesCommande, $montantTotal, "En attente");

    $viderPanier($idClient);

    return ['succes' => true, 'id_commande' => $idCommande, 'montant_total' => $montantTotal];
};
