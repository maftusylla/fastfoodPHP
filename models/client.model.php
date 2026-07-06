
<?php

$clients = [
    0 => [
        'id' => 0,
        'nom' => 'Ndiaye',
        'prenom' => 'Fatou',
        'email' => 'client@fastfood.sn',
        'mot_de_passe' => 'client123',
        'telephone' => '771234567',
        'adresse' => 'Dakar, Sénégal',
    ],
];


$rechercherClient = function (string $email, string $motDePasse): ?array {
    global $clients;
    foreach ($clients as $client) {
        if ($client['email'] === $email && $client['mot_de_passe'] === $motDePasse) {
            return $client;
        }
    }
    return null;
};
