
<?php
$commandes = [
    0 => [
        'id' => 0,
        'id_client' => 0,
        'date_commande' => '2026-07-01 12:00:00',
        'lignes_commande' => [], 
        'montant_total' => 4500,
        'statut' => 'Payée',
    ],
    1 => [
        'id' => 1,
        'id_client' => 0,
        'date_commande' => '2026-07-02 13:30:00',
        'lignes_commande' => [],
        'montant_total' => 3500,
        'statut' => 'En préparation',
    ],
];


$enregistrerCommande = function (int $idClient, array $lignesCommande, float $montantTotal, string $statut = "En attente"): int {
    global $commandes;
    $idCommande = count($commandes);
    $commandes[] = [
        'id' => $idCommande,
        'id_client' => $idClient,
        'date_commande' => date('Y-m-d H:i:s'),
        'lignes_commande' => $lignesCommande,
        'montant_total' => $montantTotal,
        'statut' => $statut,
    ];
    return $idCommande;
};

$rechercherCommandeParId = function (int $idCommande): ?array {
    global $commandes;
    foreach ($commandes as $commande) {
        if ($commande['id'] === $idCommande) {
            return $commande;
        }
    }
    return null;
};

$mettreAJourStatut = function (int $idCommande, string $statut): bool {
    global $commandes;
    foreach ($commandes as $index => $commande) {
        if ($commande['id'] === $idCommande) {
            $commandes[$index]['statut'] = $statut;
            return true;
        }
    }
    return false;
