<?php
require_once(__DIR__ . "/../models/commande.model.php");
require_once(__DIR__ . "/../models/livreur.model.php");
require_once(__DIR__ . "/../services/gerant.service.php");
require_once(__DIR__ . "/../utils/view.php");
require_once(__DIR__ . "/../views/commandes_attente.view.php");
require_once(__DIR__ . "/../views/assignation.view.php");
require_once(__DIR__ . "/../views/succes.view.php");

$listerCommandesPayees = function (): array {
    global $recupererCommandesParStatut;
    return $recupererCommandesParStatut("Payée");
};

$listerCommandesATraiter = function (): array {
    global $recupererCommandesParStatut;
    return $recupererCommandesParStatut("En préparation");
};

$afficherGestionCommandes = function (): void {
    global $listerCommandesPayees, $listerCommandesATraiter, $afficherVueCommandesAttente;
    $afficherVueCommandesAttente($listerCommandesPayees(), $listerCommandesATraiter());
};

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
