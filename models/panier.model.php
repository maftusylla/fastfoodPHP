<?php

$paniers = [];


$obtenirOuCreerPanier = function (int $idClient): array {
    global $paniers;
    foreach ($paniers as $panier) {
        if ($panier['id_client'] === $idClient) {
            return $panier;
        }
    }
    $idPanier = count($paniers);
    $nouveauPanier = [
        'id' => $idPanier,
        'id_client' => $idClient,
        'date_creation' => date('Y-m-d H:i:s'),
        'lignes' => [], 
    ];
    $paniers[] = $nouveauPanier;
    return $nouveauPanier;
};

$ajouterLignePanier = function (int $idClient, int $idPlat, int $quantite): void {
    global $paniers, $obtenirOuCreerPanier;
    $obtenirOuCreerPanier($idClient); 

    foreach ($paniers as $index => $panier) {
        if ($panier['id_client'] === $idClient) {
            $paniers[$index]['lignes'][] = ['id_plat' => $idPlat, 'quantite' => $quantite];
            return;
        }
    }
};

$obtenirLignesPanier = function (int $idClient): array {
    global $paniers;
    foreach ($paniers as $panier) {
        if ($panier['id_client'] === $idClient) {
            return $panier['lignes'];
        }
    }
    return [];
};

$viderPanier = function (int $idClient): void {
    global $paniers;
    foreach ($paniers as $index => $panier) {
        if ($panier['id_client'] === $idClient) {
            $paniers[$index]['lignes'] = [];
            return;
        }
    }
};
