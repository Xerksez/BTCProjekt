<?php
session_start();
include 'config.php';

function checkTransaction($address, $amount) {
    $transactions = json_decode(shell_exec("cd C:\Program Files\Bitcoin\daemon && bitcoin-cli -testnet listtransactions"), true);

    foreach ($transactions as $tx) {
        if (isset($tx['address']) && $tx['address'] === $address && $tx['amount'] === floatval($amount) && $tx['confirmations'] > 0) {
            return true;
        }
    }
    return false;
}

$response = ['paid' => false];

if (isset($_SESSION['bitcoinAddress']) && isset($_SESSION['bitcoinAmount'])) {
    $bitcoinAddress =number_format($_SESSION['bitcoinAddress'], 8) ;
    $bitcoinAmount = $_SESSION['bitcoinAmount'];

    if (checkTransaction($bitcoinAddress, $bitcoinAmount)) {
        $response['paid'] = true;
        unset($_SESSION['koszyk']); // Opróżnij koszyk po potwierdzeniu płatności
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>
