<?php
session_start();
include 'config.php';
function checkTransaction($address, $amount) {
    $transactions = json_decode(shell_exec("cd C:\Program Files\Bitcoin\daemon && bitcoin-cli -testnet listtransactions"), true);
    $totalSent = 0.00000000;
    $totalSentDecimal = number_format( $totalSent, 8);
    $totalSentFormatted = sprintf("%.8f", $totalSentDecimal);
    file_put_contents('log.txt', "\nbrak:". $_SESSION['brak'] . "\n", FILE_APPEND);
    foreach ($transactions as $tx) {
        $amant= $tx['amount'];
        if (isset($tx['address']) && $tx['address'] === $address && isset($tx['category']) && $tx['category'] === 'send'&& $tx['time']>$_SESSION['czas']) {
            $amantDecimal = number_format( $amant, 8);
            $amantFormatted = sprintf("%.8f", $amantDecimal);
            $totalSent += $amantFormatted;
            $totalSentDecimal = number_format( $totalSent, 8);
            $totalSentFormatted = sprintf("%.8f", $totalSentDecimal);
            file_put_contents('log.txt', "\ntsf:". $totalSentFormatted . "\n", FILE_APPEND);
            file_put_contents('log.txt', "\namant:". $amount. "\n", FILE_APPEND);
            if ($totalSentFormatted <= $amount ) {
                return true;
            }
        }
        $_SESSION['brak']=((-1*$amount)-(-1*$totalSentFormatted));
    }


    file_put_contents('log.txt', "\ntsf2:". $totalSentFormatted . "\n", FILE_APPEND);
    file_put_contents('log.txt', "\namant2:". $amount . "\n", FILE_APPEND);
    return false;
}
$response = ['paid' => false];
if (isset($_SESSION['bitcoinAmount'])) {
    $bitcoinAddress = $_SESSION['bitcoinAddress'];
    $bitcoinAmount = $_SESSION['bitcoinAmount'];
    $bitcoinAmountDecimal = (-1) * number_format($bitcoinAmount, 8);
    $bitcoinAmountFormatted = sprintf("%.8f", $bitcoinAmountDecimal);

    if (checkTransaction($bitcoinAddress, $bitcoinAmountFormatted )) {
        $response['paid'] = true;
        unset($_SESSION['koszyk']);
        unset($_SESSION['czas']);// Opróżnij koszyk po potwierdzeniu płatności
        unset($_SESSION['visited']);
    }
    $brakDecimal = number_format( $_SESSION['brak'], 8);
    $brakFormatted = sprintf("%.8f", $brakDecimal);
    $response['brak'] = $brakFormatted;

}
header('Content-Type: application/json');
echo json_encode($response);
?>
