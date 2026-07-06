<?php

$saisie = function (string $message): string {
    return readline("$message");
};

$showError = function (array $errors): void {
    foreach ($errors as $error) {
        foreach ($error as $erreur) {
            echo $erreur . "\n";
        }
    }
};

$afficherMessage = function (string $message): void {
    echo "\n>> $message\n";
};

$selectModel = function (array $datas, callable $saisie, string $message = "Faites votre choix : ", bool $returnIndex = false, string $key = "nom"): string|int {
    foreach ($datas as $index => $data) {
        echo "$index-$data[$key]\n";
    }
    $choix = (int) $saisie($message);
    return $returnIndex ? $choix : $datas[$choix][$key];
};
