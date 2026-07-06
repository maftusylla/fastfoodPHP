<?php

$plats = [
    0 => ['id' => 0, 'nom' => 'Burger Classic', 'prix' => 3500, 'description' => 'Steak, cheddar, salade, tomate', 'stock' => 20],
    1 => ['id' => 1, 'nom' => 'Poulet Braisé', 'prix' => 4500, 'description' => 'Demi-poulet braisé, frites', 'stock' => 15],
    2 => ['id' => 2, 'nom' => 'Tacos Poulet', 'prix' => 3000, 'description' => 'Tacos poulet, sauce fromagère', 'stock' => 0],
];


$consulterStock = function (int $idPlat): bool {
    global $plats;
    foreach ($plats as $plat) {
        if ($plat['id'] === $idPlat) {
            return $plat['stock'] > 0;
        }
    }
    return false;
};

$rechercherPlatParId = function (int $idPlat): ?array {
    global $plats;
    foreach ($plats as $plat) {
        if ($plat['id'] === $idPlat) {
            return $plat;
        }
    }
    return null;
};

$ajouterPlat = function (string $nom, float $prix, string $description): void {
    global $plats;
    $plats[] = [
        'id' => count($plats),
        'nom' => $nom,
        'prix' => $prix,
        'description' => $description,
        'stock' => 10,
    ];
};
