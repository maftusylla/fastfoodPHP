<?php


require_once(__DIR__ . "/models/plat.model.php");
require_once(__DIR__ . "/models/commande.model.php");
require_once(__DIR__ . "/models/panier.model.php");
require_once(__DIR__ . "/models/paiement.model.php");
require_once(__DIR__ . "/models/reçu.model.php");
require_once(__DIR__ . "/models/livreur.model.php");
require_once(__DIR__ . "/models/notification.model.php");
require_once(__DIR__ . "/models/client.model.php");
require_once(__DIR__ . "/models/gerant.model.php");

require_once(__DIR__ . "/utils/view.php");
require_once(__DIR__ . "/utils/validator.php");
require_once(__DIR__ . "/utils/commande.validator.php");

require_once(__DIR__ . "/services/commande.service.php");
require_once(__DIR__ . "/services/paiement.service.php");
require_once(__DIR__ . "/services/gerant.service.php");

require_once(__DIR__ . "/controllers/utilisateur.controller.php");
require_once(__DIR__ . "/controllers/commande.controller.php");
require_once(__DIR__ . "/controllers/paiement.controller.php");
require_once(__DIR__ . "/controllers/gerant.controller.php");
require_once(__DIR__ . "/controllers/catalogue.controller.php");

require_once(__DIR__ . "/views/historique.view.php");

$afficherHistorique = function (): void {
    global $commandes, $utilisateurConnecte, $afficherVueHistorique;
    $idClient = $utilisateurConnecte['id'] ?? 0;
    $mesCommandes = array_values(array_filter($commandes, function ($c) use ($idClient) {
        return $c['id_client'] === $idClient;
    }));
    $afficherVueHistorique($mesCommandes);
};

$menuClient = function (): void {
    global $saisie, $parcourirMenu, $choisirPaiement, $afficherHistorique;
    do {
        echo "\n MENU CLIENT \n";
        echo "1-Voir le menu et commander\n";
        echo "2-Payer une commande en attente\n";
        echo "3-Historique de mes commandes\n";
        echo "0-Quitter\n";
        $choix = $saisie("Votre choix : ");
        switch ($choix) {
            case '1': $parcourirMenu(); break;
            case '2': $choisirPaiement(); break;
            case '3': $afficherHistorique(); break;
        }
    } while ($choix !== '0');
};

$menuGerant = function (): void {
    global $saisie, $traiterAjoutPlat, $afficherGestionCommandes, $validerCommande, $assignerLivreur;
    do {
        echo "\nMENU GERANT \n";
        echo "1-Ajouter un plat au catalogue\n";
        echo "2-Lister les commandes \n";
        echo "3-Valider une commande \n";
        echo "4-Assigner un livreur \n";
        echo "0-Quitter\n";
        $choix = $saisie("Votre choix : ");
        switch ($choix) {
            case '1': $traiterAjoutPlat(); break;
            case '2': $afficherGestionCommandes(); break;
            case '3': $validerCommande(); break;
            case '4': $assignerLivreur(); break;
        }
    } while ($choix !== '0');
};

$demarrerApplication = function (): void {
    global $connecter, $menuClient, $menuGerant, $roleConnecte;

    echo "SYSTEME DE COMMANDE FAST-FOOD \n";
    $connecter();

    if ($roleConnecte === 'gerant') {
        $menuGerant();
    } else {
        $menuClient();
    }

    echo "\nAu revoir !\n";
};

$demarrerApplication();
