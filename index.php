<?php
require_once(__DIR__ . "/../model/commande.model.php");
require_once(__DIR__ . "/../model/livreur.model.php");
require_once(__DIR__ . "/../service/gerant.service.php");
require_once(__DIR__ . "/../utils/view.php");
require_once(__DIR__ . "/../view/commandes_attente.view.php");
require_once(__DIR__ . "/../view/assignation.view.php");
require_once(__DIR__ . "/../view/succes.view.php");

$listerCommandesPayees = function (): array {
    global $recupererCommandesParStatut;
    return $recupererCommandesParStatut("Payée");
};

$afficherGestionCommandes = function (): void {
    global $listerCommandesPayees, $listerCommandesATraiter, $afficherVueCommandesAttente;
    $afficherVueCommandesAttente($listerCommandesPayees(), $listerCommandesATraiter());
};

// Scénario 3 - RG2 (saisie) puis délégation au Service pour RG3/RG4
$validerCommande = function (): void {
    global $saisie, $traiterValidationCommande, $afficherMessage, $afficherVueSucces;

    $idCommande = (int) $saisie("ID de la commande a valider : ");

    $resultat = $traiterValidationCommande($idCommande);

    if (!$resultat['succes']) {
        $afficherMessage($resultat['erreur']);
        return;
    }

    $afficherVueSucces("Commande n{$idCommande} en préparation");
};