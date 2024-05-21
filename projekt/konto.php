<?php
include 'config.php';
session_start();
$id=$_SESSION['id'];
$uzy = "SELECT * from uzytkownik where id='$id'";
$select = mysqli_query($conn,$uzy);
$uzy = mysqli_fetch_assoc($select);

$opinia= "SELECT tytul, tekst, opinia.ocena,id_produktu FROM opinia join produkty on produkty.id=opinia.id_produktu where id_uzytkownika='$id'";
$select2 = mysqli_query($conn,$opinia);
$e=$_SESSION['email'];

$zamowienie= "SELECT * FROM zamowienia where email='$e'";
$select4 = mysqli_query($conn,$zamowienie);


if(isset($_POST['usuwaniekonta']))
{
    $query = "delete from opinia where id_uzytkownika ='$id'";
    $conn->query($query);
    $query = "delete from uzytkownik where id ='$id'";
    $conn->query($query);
    session_destroy();
    header("Location:index.php");

}
?>
<html>
<head>

    <link rel="stylesheet" href="css.css">
    <link rel="shortcut icon" href=favicon.ico>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
<a href="index.php">
    <img class="image" style="float: left" src =i.png>
</a>
<div class="dane">
Dane konta:
<?php
echo'
<b>
<br>Nazwa:
 ' . $uzy['nazwa'] . '
 <br>
 Email:
 ' . $uzy['email'] . '
</div>
<a href="edytowanie3.php?id='.$id.'" class="btn btn-secondary"><h3>EDYTUJ DANE</h3></a>

</form>
<br>
</b>
<form method="post">
';
?>
<input type="submit" name="usuwaniekonta" value="Usuń konto" onclick="return confirm('Czy na pewno chcesz usunąć konto?')">
<?php
echo'
<br>

<h4>
<b>
Twoje komentarze:
</b>
</h4>

';
while($opinia = mysqli_fetch_assoc($select2 )) {
    echo '
    <br>
    <input type="text" name="nazwa" disabled value="' . $opinia['tytul'] . '" >
   <input type="text" name="tekst" disabled  value="' . $opinia['tekst'] . '" >
    <input type="text" name="ocena" disabled value="' . $opinia['ocena'] . '/5" >
    ';
    $o=$opinia['id_produktu'];
echo'
 <a href="szczegoly.php?id='.$o.'" class="btn btn-secondary"><h3><b>Przejdz do opinii</b></h3></a>
 

    ';
}
echo '<h2 style="margin-left: 850px;">ZAMÓWIENIA:</h2>';
while($zamowienie = mysqli_fetch_assoc($select4)) {

    echo'
 <div class="produkt2">
    Koszt całego zamówienia: ' .number_format( $zamowienie['koszt'],2 ). 'zł'.'
    <br>
   Miasto: ' . $zamowienie['miasto'] . '
   <br>
    Metoda płatności: ' . $zamowienie['metoda_p'] . '
      <br>
    Metoda dostawy:' . $zamowienie['metoda_d'] . '
      <br>
    Numer telefonu:' . $zamowienie['numer'] . '
      <br>
    Email: ' . $zamowienie['email'] . '
      <br>
    Imię: ' . $zamowienie['imie'] . '
      <br>
   Nazwisko: ' . $zamowienie['nazwisko'] . '
     <br>
   Kod pocztowy:  ' . $zamowienie['kod'] . '
     <br>
   Data:  ' . $zamowienie['data'] . '
 </div>
    ';

}
        ?>

</body>
</html>
