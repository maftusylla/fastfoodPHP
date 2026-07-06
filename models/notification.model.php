

$creerNotification = function (int $idDestinataire, string $message): bool {
    global $notifications;
    $notifications[] = [
        'id' => count($notifications),
        'id_destinataire' => $idDestinataire,
        'message' => $message,
    ];
    return true;
};
