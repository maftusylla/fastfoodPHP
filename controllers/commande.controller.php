<?php
require_once(__DIR__ . "/../models/plat.model.php");
require_once(__DIR__ . "/../models/panier.model.php");
require_once(__DIR__ . "/../services/commande.service.php");
require_once(__DIR__ . "/../utils/view.php");
require_once(__DIR__ . "/../views/menu.view.php");
require_once(__DIR__ . "/../views/panier.view.php");
require_once(__DIR__ . "/../views/confirmation.view.php");


$parcourirMenu = function (): void {
    global $plats, $afficherVueMenu, $saisie, $ajouterLignePanier, $obtenirLignesPanier,
           $afficherVuePanier, $utilisateurConnecte, $validerPanier;

    $idClient = $utilisateurConnecte['id'] ?? 0;

    $afficherVueMenu($plats);

    do {
        $idPlat = (int) $saisie("\nID du plat a ajouter (-1 pour arreter) : ");
        if ($idPlat === -1) break;
        $quantite = (int) $saisie("Quantite : ");
        $ajouterLignePanier($idClient, $idPlat, $quantite);
    } while (true);

    $afficherVuePanier($obtenirLignesPanier($idClient));

    $confirmer = $saisie("\nValider la commande ? (o/n) : ");
    if (strtolower($confirmer) === 'o') {
        $validerPanier();
    }
};

$validerPanier = function (): void {
    global $traiterPasserCommande, $utilisateurConnecte, $afficherMessage, $afficherVueConfirmation;

    $idClient = $utilisateurConnecte['id'] ?? 0;
    $resultat = $traiterPasserCommande($idClient);

    if (!$resultat['succes']) {
        $afficherMessage($resultat['erreur']);
        return;
    }

    $afficherVueConfirmation($resultat['id_commande']);
};

