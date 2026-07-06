<?php
require_once(__DIR__ . "/../models/plat.model.php");
require_once(__DIR__ . "/../utils/validator.php");
require_once(__DIR__ . "/../utils/view.php");
require_once(__DIR__ . "/../views/gestion_menu.view.php");

$traiterAjoutPlat = function (): void {
    global $required, $errorExist, $showError, $saisie, $ajouterPlat, $afficherMessage, $plats, $afficherVueGestionMenu;

    $afficherVueGestionMenu($plats);

    do {
        $errors = [];
        $nom = $saisie("\nNom du plat : ");
        $prix = $saisie("Prix : ");
        $description = $saisie("Description : ");

        $required($errors, "Le nom est obligatoire", $nom, 'nom');
        $required($errors, "Le prix est obligatoire", $prix, 'prix');
        $showError($errors);
    } while ($errorExist($errors));

    $ajouterPlat($nom, (float) $prix, $description);
    $afficherMessage("Plat '$nom' ajoute au catalogue.");
};
