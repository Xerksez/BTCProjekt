<?php
session_start();
include 'config.php';

spl_autoload_register(function ($opinia) {
    include $opinia . '.php';
});

$id=$_GET['id'];

$produkt= "SELECT * FROM produkty where produkty.id='$id'";
$select = mysqli_query($conn,$produkt);

$produkt2= "SELECT * FROM opinia join uzytkownik on uzytkownik.id=opinia.id_uzytkownika where id_produktu='$id'";
$select2 = mysqli_query($conn,$produkt2);


if(empty($_SESSION['id'])) {
    $_SESSION['id'] = 0;
}

?>
<html>
<head>

    <link rel="stylesheet" href="/path/to/cdn/font-awesome.min.css" />
    <link rel="stylesheet" href="/path/to/cdn/font-awesome.min.css" />
    <link rel="stylesheet" href="css.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>
        Najlepszy chiński market w Polsce!
    </title>
    <meta charset="utf-8">
</head>
<body>
<a href="indexa.php">
    <img class="image" style="float: left" src =i.png>
</a>
<?php

while($produkt = mysqli_fetch_assoc($select)) {
    echo '
    <div class ="produkt">
<img src="' . $produkt['zdjecie'] . '" width="100px" height="100px" class="zdjecie">

Nazwa:  ' . $produkt['tytul'] . '
<br>
Opis:  ' . $produkt['opis'] . '
<br>
Cena bez dostawy:   ' . $produkt['cena_bez'] . '
<br>
Ilość: ' . $produkt['ilosc'] . ' 
<br>
Więcej informacji: ' . $produkt['opisDuzy'] . ' <br>
</div >
';
}
while($produkt2 = mysqli_fetch_assoc($select2)) {

    $opinia=$produkt2['tekst'];
    $produkt3= "SELECT * FROM opinia where id_produktu='$id' and tekst='$opinia'";
    $select3 = mysqli_query($conn,$produkt3);
    $produkt3 = mysqli_fetch_assoc($select3);
    $ido=$produkt3['id'];
    $n=$produkt2['nazwa'];

    echo'
    <br>
       <form method="post">
    <input type="text" name="nazwa"  value="'.$n.'" >
    <input type="hidden" name="id" value="'.$ido.'" >
   <input type="text" name="tekst" value="'.$produkt2['tekst'].'" >
    <input type="text" name="ocena" max="5" pattern="\d+" value="'.$produkt2['ocena'] .'/5" >
 
   
    ';
    ?>

    <?php
        echo'  
    <a href="usuwanie3a.php?id='.$_GET['id'].'&ido='.$ido.'" class="btn btn-success" >usuń</a> 
    ';
}
?>




</body>
</html>
