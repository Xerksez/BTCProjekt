<?php

// Tworzenie tablicy odpowiedzi
$response = array();

// Sprawdzenie dostępności bitcoin-cli
$bitcoin_cli_output = shell_exec('bitcoin-cli help');

if (strpos($bitcoin_cli_output, 'bitcoin-cli: command not found') !== false) {
    $response['available'] = false;
} else {
    $response['available'] = true;
}

// Ustawienie nagłówka odpowiedzi na JSON
header('Content-Type: application/json');

// Wyślij odpowiedź w formacie JSON
echo json_encode($response);
