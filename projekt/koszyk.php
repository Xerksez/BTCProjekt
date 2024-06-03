<?php
session_start();
include 'config.php';


spl_autoload_register(function ($zamowienie) {
    include $zamowienie . '.php';
});



if (!empty($_POST['dodaj'])) {
    $d = date('d/m/y H:i:s');
    $z = new zamowienie($d, $_SESSION['calosc'], $_POST['adres'], $_POST['miasto'], 'Bitcoin', $_POST['metoda_d'], $_POST['numer'], $_SESSION['email'], $_POST['imie'], $_POST['nazwisko'], $_POST['kod']);
    $z->Dodaj();

    $_SESSION['bitcoinAmount'] = ($_SESSION['calosc'])*(0.0000038);
    header('Location: platnosc.php');
    exit();
}
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
    <br>
    TWÓJ KOSZYK:
</b>
<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th>Tytul</th>
            <th>Ilość</th>
            <th>Cena bez dostawy</th>
            <th>Cena z dostawą</th>
            <th>Koszt</th>
            <th>Usuwanie</th>
        </tr>
        <?php
        if (!empty($_SESSION['koszyk'])) {
        $calosc = 0;
        foreach ($_SESSION['koszyk'] as $keys => $wartosci) {

            ?>
        <tr>
            <td><?php echo $wartosci['tytul']; ?></td>
            <td><?php echo $wartosci['ilosc']; ?></td>
            <td><?php echo $wartosci['cena_bez'] . ' zł'; ?></td>
            <td><?php echo $wartosci['cena_z'] . ' zł'; ?></td>
            <td><?php echo number_format(($wartosci['ilosc'] * $wartosci['cena_bez']) + ($wartosci['cena_z'] - $wartosci['cena_bez']), 2) . ' zł'; ?></td>
            <td><a href="koszyk.php?akcja=usun&id=<?php echo $wartosci['id'] ?>" onclick="return confirm('Czy na pewno chcesz usunąć ten produkt?')"> Usuń</a></td>
        </tr>
            <?php
            $calosc = $calosc + ($wartosci['ilosc'] * $wartosci['cena_bez']) + ($wartosci['cena_z'] - $wartosci['cena_bez']);
            $_SESSION['calosc'] = $calosc;
        }
            ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Całość za zamówienie</td>
                <td><?php echo number_format($calosc, 2) . ' zł' ?></td>
            </tr>
            <tr>
                <td colspan="6" style="text-align: right;">
                    <form method="post" action="koszyk.php">
                        <input type="hidden" name="dodaj" value="1">
                        <button type="submit" class="btn btn-primary">Przejdź do płatności Bitcoin</button>
                    </form>
                </td>
            </tr>
            <?php
        }
        if (isset($_GET['akcja'])) {
            if ($_GET['akcja'] == 'usun') {
                foreach ($_SESSION['koszyk'] as $keys => $wartosci) {
                    if ($wartosci['id'] == $_GET['id']) {
                        $i = $wartosci['ilosc'];
                        $idp = $wartosci['id'];
                        $query = "UPDATE produkty SET ilosc=ilosc +'$i' WHERE id='$idp'";
                        $conn->query($query);
                        unset($_SESSION['koszyk'][$keys]);
                        echo '<script> alert("Produkt usunięty!")</script>';
                        echo '<script> window.location="koszyk.php"</script>';
                    }
                }
            }
        }
        ?>
    </table>

</div>
<!-- Test: Czy bitcoin-cli jest dostępny -->
<script src="check_bitcoin_cli.js"></script>

</body>
</html>
```
