
<?php

$gerants = [
    0 => [
        'id' => 0,
        'nom' => 'Diallo',
        'prenom' => 'Mamadou',
        'email' => 'gerant@fastfood.sn',
        'mot_de_passe' => 'gerant123',
    ],
];

$rechercherGerant = function (string $email, string $motDePasse): ?array {
    global $gerants;
    foreach ($gerants as $gerant) {
        if ($gerant['email'] === $email && $gerant['mot_de_passe'] === $motDePasse) {
            return $gerant;
        }
    }
    return null;
};
