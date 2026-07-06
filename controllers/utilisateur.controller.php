<?php
require_once(__DIR__ . "/../models/client.model.php");
require_once(__DIR__ . "/../models/gerant.model.php");
require_once(__DIR__ . "/../utils/view.php");
require_once(__DIR__ . "/../utils/validator.php");

$utilisateurConnecte = null;
$roleConnecte = null; 

$connecter = function (): array {
    global $rechercherClient, $rechercherGerant, $saisie, $showError, $required, $errorExist,
           $utilisateurConnecte, $roleConnecte;

    do {
        $errors = [];
        echo "\n=== CONNEXION ===\n";
        $email = $saisie("Email : ");
        $motDePasse = $saisie("Mot de passe : ");

        $required($errors, "L'email est obligatoire", $email, 'email');
        $required($errors, "Le mot de passe est obligatoire", $motDePasse, 'mot_de_passe');

        $utilisateur = null;
        $role = null;

        if (!$errorExist($errors)) {
            $client = $rechercherClient($email, $motDePasse);
            if ($client !== null) {
                $utilisateur = $client;
                $role = 'client';
            } else {
                $gerant = $rechercherGerant($email, $motDePasse);
                if ($gerant !== null) {
                    $utilisateur = $gerant;
                    $role = 'gerant';
                }
            }

            if ($utilisateur === null) {
                $errors['auth']['invalide'] = "Email ou mot de passe incorrect.";
            }
        }
        $showError($errors);
    } while ($errorExist($errors));

    $utilisateurConnecte = $utilisateur;
    $roleConnecte = $role;
    return $utilisateur;
};
