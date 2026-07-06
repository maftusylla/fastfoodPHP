<?php

$required = function (array &$errors, string $message, string $value, string $key) {
    if (empty($value)) {
        $errors[$key]["required"] = $message;
    }
};

$unique = function (array $datas, array &$errors, string $message, string $value, string $key) {
    foreach ($datas as $data) {
        if (isset($data[$key]) && $data[$key] == $value) {
            $errors[$key]["unique"] = $message;
        }
    }
};

// Verifie qu'une valeur existe dans un tableau et retourne son index, sinon -1
$existeValue = function (array &$errors, array $datas, string $value, string $key, string $message): int {
    foreach ($datas as $index => $data) {
        if ($data[$key] == $value) {
            return $index;
        }
    }
    $errors[$key]["isExiste"] = $message;
    return -1;
};

$errorExist = function (array $errors): bool {
    return count($errors) !== 0;
};
