<?php
session_start();

if (!isset($_SESSION['bitcoinAmount'])) {
    echo "Brak do zapłaty.";
    exit();
}
if (!isset($_SESSION['visited'])) {
    $_SESSION['visited'] = true;
    $_SESSION['czas']=time();
}

$bitcoinAddress = "tb1q8q2qtk250m5z64mamqaz68fwwylhlcxj8rwue2";
$bitcoinAmount = $_SESSION['bitcoinAmount'];
?>

<html>
<head>
    <link rel="stylesheet" href="css.css">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
<a href="index.php">
    <img class="image" style="float: left" src="i.png">
</a>
<b>
    <br>
    <br>
    <br>
    <br>
    <a href="koszyk.php" class="btn btn-secondary">Wróć do koszyka</a>
    <p1 style="font-size: xx-large">Płatność Bitcoin:</p1>
</b>
<div class="container">
    <div class="alert alert-info" role="alert" style="font-size: x-large"  >
        Proszę przelać <?php echo number_format($bitcoinAmount, 8); ?> BTC na adres: <strong><?php echo $bitcoinAddress; ?></strong>
    </div>
    <img src="qr.png" style="margin-left: 395px;">
    <br>
    <br>
    <button class="btn btn-primary" style="margin-left: 418px; font-size: x-large" onclick="checkBitcoinPayment()">Sprawdź status płatności</button>
</div>

<script>
    function checkBitcoinPayment() {

        fetch('check_payment.php')

            .then(response => response.json())
            .then(data => {
                if (data.paid) {
                    alert('Płatność została wysłana, dziękujemy za zakup.');
                    window.location.href = 'index.php';
                } else {
                    alert('Cała kwota nie została jeszcze wysłana, pozostało Brakuje '+ data.brak +' BTC. Spróbuj ponownie odświeżyć za kilka minut.');
                }
            })
            .catch(error => {
                console.error('Błąd:', error);
            });
    }
</script>
</body>
</html>
