// Test: Czy bitcoin-cli jest dostępny
function isBitcoinCliAvailable() {
    fetch('check_bitcoin_cli.php')
        .then(response => response.json())
        .then(data => {
            if (data.available) {
                console.log('bitcoin-cli jest dostępny.');
                console.log(data);
            } else {
                console.log('bitcoin-cli nie jest dostępny.');
            }
        })
        .catch(error => {
            console.error('Błąd:', error);
        });
}

// Wywołanie funkcji sprawdzającej dostępność bitcoin-cli
isBitcoinCliAvailable();
