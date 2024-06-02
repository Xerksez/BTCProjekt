<?php
session_start();
include 'config.php';

function checkTransaction($address, $amount) {
    $transactions = json_decode(shell_exec("cd C:\Program Files\Bitcoin\daemon && bitcoin-cli -testnet listtransactions"), true);

    foreach ($transactions as $tx) {
        if (isset($tx['address']) && $tx['address'] === $address && $tx['amount'] === floatval($amount)) {
            return true;
        }
    }
    return false;
}

$response = ['paid' => false];

if (isset($_SESSION['bitcoinAddress']) && isset($_SESSION['bitcoinAmount'])) {
    $bitcoinAddress =$_SESSION['bitcoinAddress'] ;
    $bitcoinAmount = (-1)*(number_format($_SESSION['bitcoinAmount'], 8));

    if (checkTransaction($bitcoinAddress, $bitcoinAmount)) {
        $response['paid'] = true;
        unset($_SESSION['koszyk']); // Opróżnij koszyk po potwierdzeniu płatności
    }
}
header('Content-Type: application/json');
echo json_encode($response);
?>
