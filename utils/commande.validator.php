<?php


require_once(__DIR__ . "/../models/plat.model.php");

$verifierDisponibilite = function (array $panier): bool {
    global $consulterStock;
    foreach ($panier as $ligne) {
        $disponible = $consulterStock($ligne['id_plat']);
        if (!$disponible) {
            return false;
        }
    }
    return true;
};
