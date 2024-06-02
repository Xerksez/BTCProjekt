$address = 'ADRES_GENEROWANY_PRZEZ_SKRYPT';
$amount = $_SESSION['calosc'];

if (checkTransaction($address, $amount)) {
// Aktualizacja statusu zamówienia
echo "Płatność została potwierdzona.";
} else {
echo "Oczekiwanie na płatność.";
}
