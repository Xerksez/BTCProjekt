<?php
session_start();
include 'config.php';
$id=$_GET['id'];
$produkt= "SELECT * FROM produkty where id='$id'";
$select = mysqli_query($conn,$produkt);
$produkt = mysqli_fetch_assoc($select);
echo'
<html>
<head>
  <link rel="stylesheet" href="css.css">
    <link rel="shortcut icon" href=favicon.ico>
</head>
<body>
<form method="post">
<b>
EDYTUJ PRODUKT:
</b>
    <input name="tytul" required placeholder="tytul" value="'.$produkt['tytul'].'">
    <input name="zdjecie" required placeholder="zdjecie"value="'.$produkt['zdjecie'].'">
    <input name="cena_bez" required pattern="\d+" placeholder="cena_bez" value="'.$produkt['cena_bez'].'">
    <input name="cena_z" required pattern="\d+" placeholder="cena_z" value="'.$produkt['cena_z'].'">
    <input name="opis" required placeholder="opis" value="'.$produkt['opis'].'">
    <input name="ilosc" required pattern="\d+" placeholder="ilosc" value="'.$produkt['ilosc'].'">
    <input name="opisDuzy" required placeholder="opisDuzy" value="'.$produkt['opisDuzy'].'">
     <input name="rodzaj" required placeholder="rodzaj" value="'.$produkt['rodzaj'].'">
    <input type="submit" name="dodaj" value="Edytuj">
    </form>
    </body>
    </html>
';
if(isset($_POST['dodaj'])) {
    $t = $_POST['tytul'];
    $z = $_POST['zdjecie'];
    $cb = $_POST['cena_bez'];
    $cz = $_POST['cena_z'];
    $o = $_POST['opis'];
    $i = $_POST['ilosc'];
    $od = $_POST['opisDuzy'];
    $r=$_POST['rodzaj'];
    $query = "update produkty set tytul='$t',zdjecie='$z',cena_bez='$cb',cena_z='$cz',opis='$o',ilosc='$i',opisDuzy='$od',rodzaj='$r' where id ='$id'";
    $conn->query($query);
    header("Location:indexa.php");
}
