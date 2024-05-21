<?php

session_start();
include 'config.php';

$id=$_SESSION['id'];
$uzy = "SELECT * from uzytkownik where id='$id'";
$select2 = mysqli_query($conn,$uzy);
$uzy = mysqli_fetch_assoc($select2);
$idu=$uzy['id'];
spl_autoload_register(function ($produkt) {
    include $produkt . '.php';
});

if(empty($_SESSION['admin']))
{
    $_SESSION['admin']=0;
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
    <title>
        Najlepszy chiński market w Polsce!
    </title>
    <meta charset="utf-8">
</head>
<body>

<header>
    <a href="indexa.php">
        <img class="image" style="float: left" src =i.png>
    </a>
  <?php
  echo'
  <h1>
      <a href="kontoa.php?idu='.$idu.'">Moje konto</a></h1>';

        echo'<h2>Zalogowano jako: '.$uzy['nazwa'].'</h2><a href="wyloguj.php"><h3>Wyloguj</h3></a>';

    ?>
</header>
<br>
<br>
<br>
<br>
<div class="filtr">
Filtrowanie:
<form method="post">
<select name="rodzaj">
    <option value="wszystko">Wszystko</option>
    <option value="zabawki">Zabawki</option>
    <option value="jedzenie">Jedzenie</option>
    <option value="ubranie">Ubrania</option>
    <option value="porcelana">Porcelana</option>
</select>
    <select name="cena">
        <option value="rosnaco">Cena rosnąco</option>
        <option value="malejaco">Cena malejąco</option>
    </select>
    cena od:
    <input type="text" name="cenaod" placeholder="od">
    cena do:
    <input type="text" name="cenado" placeholder="do">
    <input type="submit" name="filtr">
</form>
</div>

<br>
<?php

if(empty($_POST['filtr']))
{
    $produkt= "SELECT id,tytul,zdjecie,cena_z,cena_bez,rodzaj,opis,ilosc,ocena  FROM produkty order by tytul";
    $select = mysqli_query($conn,$produkt);

}else{
    if($_POST['rodzaj']=="wszystko"&&$_POST['cena']=="rosnaco")
    {
        if($_POST['cenaod']==null||$_POST['cenado']==null)
        {
            $produkt= "SELECT id,tytul,zdjecie,cena_z,cena_bez,rodzaj,opis,ilosc,ocena  FROM produkty order by cena_bez asc";
            $select = mysqli_query($conn,$produkt);
        }else
        {
            $co=$_POST['cenaod'];
            $cd=$_POST['cenado'];
            $produkt= "SELECT id,tytul,zdjecie,cena_z,cena_bez,rodzaj,opis,ilosc,ocena  FROM produkty where cena_bez BETWEEN '$co' and '$cd' order by cena_bez asc ";
            $select = mysqli_query($conn,$produkt);
        }

    }elseif($_POST['rodzaj']=="zabawki"&&$_POST['cena']=="rosnaco"){
        if($_POST['cenaod']==null||$_POST['cenado']==null)
        {
            $z="zabawka";
            $produkt= "SELECT id,tytul,zdjecie,cena_z,cena_bez,rodzaj,opis,ilosc,ocena  FROM produkty where rodzaj='$z' order by cena_bez asc ";
            $select = mysqli_query($conn,$produkt);
        }else
        {
            $z="zabawka";
            $co=$_POST['cenaod'];
            $cd=$_POST['cenado'];
            $produkt= "SELECT id,tytul,zdjecie,cena_z,cena_bez,rodzaj,opis,ilosc,ocena  FROM produkty where rodzaj='$z' and cena_bez BETWEEN '$co' and '$cd' order by cena_bez asc ";
            $select = mysqli_query($conn,$produkt);
        }

    }elseif($_POST['rodzaj']=="jedzenie"&&$_POST['cena']=="rosnaco"){
        if($_POST['cenaod']==null||$_POST['cenado']==null)
        {
        $j="jedzenie";
        $produkt= "SELECT id,tytul,zdjecie,cena_z,cena_bez,rodzaj,opis,ilosc,ocena  FROM produkty where rodzaj='$j' order by cena_bez asc";
        $select = mysqli_query($conn,$produkt);
        }else
        {
            $j="jedzenie";
            $co=$_POST['cenaod'];
            $cd=$_POST['cenado'];
            $produkt= "SELECT id,tytul,zdjecie,cena_z,cena_bez,rodzaj,opis,ilosc,ocena  FROM produkty where rodzaj='$j' and cena_bez BETWEEN '$co' and '$cd' order by cena_bez asc ";
            $select = mysqli_query($conn,$produkt);
        }

    }elseif($_POST['rodzaj']=="wszystko"&&$_POST['cena']=="malejaco")
    {
        if($_POST['cenaod']==null||$_POST['cenado']==null)
        {
            $produkt= "SELECT id,tytul,zdjecie,cena_z,cena_bez,rodzaj,opis,ilosc,ocena  FROM produkty order by cena_bez desc";
            $select = mysqli_query($conn,$produkt);
        }else
        {
            $co=$_POST['cenaod'];
            $cd=$_POST['cenado'];
            $produkt= "SELECT id,tytul,zdjecie,cena_z,cena_bez,rodzaj,opis,ilosc,ocena  FROM produkty where cena_bez BETWEEN '$co' and '$cd' order by cena_bez desc ";
            $select = mysqli_query($conn,$produkt);
        }


    }elseif($_POST['rodzaj']=="zabawki"&&$_POST['cena']=="malejaco") {
        if($_POST['cenaod']==null||$_POST['cenado']==null)
        {
            $z = "zabawka";
            $produkt = "SELECT id,tytul,zdjecie,cena_z,cena_bez,rodzaj,opis,ilosc,ocena  FROM produkty where rodzaj='$z order by cena_bez desc'";
            $select = mysqli_query($conn, $produkt);
        }else
        {
            $z="zabawka";
            $co=$_POST['cenaod'];
            $cd=$_POST['cenado'];
            $produkt= "SELECT id,tytul,zdjecie,cena_z,cena_bez,rodzaj,opis,ilosc,ocena  FROM produkty where rodzaj='$z' and cena_bez BETWEEN '$co' and '$cd' order by cena_bez desc ";
            $select = mysqli_query($conn,$produkt);
        }


    }elseif($_POST['rodzaj']=="jedzenie"&&$_POST['cena']=="malejaco"){
        if($_POST['cenaod']==null||$_POST['cenado']==null)
        {
            $j="jedzenie";
            $produkt= "SELECT id,tytul,zdjecie,cena_z,cena_bez,rodzaj,opis,ilosc,ocena  FROM produkty where rodzaj='$j' order by cena_bez desc";
            $select = mysqli_query($conn,$produkt);
        }else
        {
            $j="jedzenie";
            $co=$_POST['cenaod'];
            $cd=$_POST['cenado'];
            $produkt= "SELECT id,tytul,zdjecie,cena_z,cena_bez,rodzaj,opis,ilosc,ocena  FROM produkty where rodzaj='$j' and cena_bez BETWEEN '$co' and '$cd' order by cena_bez desc";
            $select = mysqli_query($conn,$produkt);
        }

    }elseif($_POST['rodzaj']=="porcelana"&&$_POST['cena']=="rosnaco") {
        if ($_POST['cenaod'] == null || $_POST['cenado'] == null) {

            $p = "porcelana";
            $produkt = "SELECT id,tytul,zdjecie,cena_z,cena_bez,rodzaj,opis,ilosc,ocena  FROM produkty where rodzaj='$p' order by cena_bez asc";
            $select = mysqli_query($conn, $produkt);
        } else {
            $p = "porcelana";
            $co = $_POST['cenaod'];
            $cd = $_POST['cenado'];
            $produkt = "SELECT id,tytul,zdjecie,cena_z,cena_bez,rodzaj,opis,ilosc,ocena  FROM produkty where rodzaj='$p' and cena_bez BETWEEN '$co' and '$cd' order by cena_bez asc ";
            $select = mysqli_query($conn, $produkt);
        }

    }elseif($_POST['rodzaj']=="porcelana"&&$_POST['cena']=="malejaco") {
        if ($_POST['cenaod'] == null || $_POST['cenado'] == null) {
            $p = "porcelana";
            $produkt = "SELECT id,tytul,zdjecie,cena_z,cena_bez,rodzaj,opis,ilosc,ocena  FROM produkty where rodzaj='$p' order by cena_bez desc";
            $select = mysqli_query($conn, $produkt);
        } else {
            $p = "porcelana";
            $co = $_POST['cenaod'];
            $cd = $_POST['cenado'];
            $produkt = "SELECT id,tytul,zdjecie,cena_z,cena_bez,rodzaj,opis,ilosc,ocena  FROM produkty where rodzaj='$p' and cena_bez BETWEEN '$co' and '$cd' order by cena_bez desc";
            $select = mysqli_query($conn, $produkt);
        }
    }elseif($_POST['rodzaj']=="ubranie"&&$_POST['cena']=="rosnaco") {
        if ($_POST['cenaod'] == null || $_POST['cenado'] == null) {

            $u = "ubranie";
            $produkt = "SELECT id,tytul,zdjecie,cena_z,cena_bez,rodzaj,opis,ilosc,ocena  FROM produkty where rodzaj='$u' order by cena_bez asc";
            $select = mysqli_query($conn, $produkt);
        } else {
            $u = "ubranie";
            $co = $_POST['cenaod'];
            $cd = $_POST['cenado'];
            $produkt = "SELECT id,tytul,zdjecie,cena_z,cena_bez,rodzaj,opis,ilosc,ocena  FROM produkty where rodzaj='$u' and cena_bez BETWEEN '$co' and '$cd' order by cena_bez asc ";
            $select = mysqli_query($conn, $produkt);
        }

    }elseif($_POST['rodzaj']=="ubranie"&&$_POST['cena']=="malejaco") {
        if ($_POST['cenaod'] == null || $_POST['cenado'] == null) {
            $u = "ubranie";
            $produkt = "SELECT id,tytul,zdjecie,cena_z,cena_bez,rodzaj,opis,ilosc,ocena  FROM produkty where rodzaj='$u' order by cena_bez desc";
            $select = mysqli_query($conn, $produkt);
        } else {
            $u = "ubranie";
            $co = $_POST['cenaod'];
            $cd = $_POST['cenado'];
            $produkt = "SELECT id,tytul,zdjecie,cena_z,cena_bez,rodzaj,opis,ilosc,ocena FROM produkty where rodzaj='$u' and cena_bez BETWEEN '$co' and '$cd' order by cena_bez desc";
            $select = mysqli_query($conn, $produkt);
        }
    }
}


while($produkt = mysqli_fetch_assoc($select)) {
    echo'
   <div class ="produkt">';
    if($_SESSION['admin']==1) {
        echo '
    <a href=usuwanie.php?id=' . $produkt['id'] . '>Usuń</a>
    
    
    <a href=edytowanie.php?id=' . $produkt['id'] . '>Edytuj</a>
    
    '
        ;
    }

    echo'
<a href="szczegolya.php?id= '.$produkt['id'].'">
     <img src="'.$produkt['zdjecie'].'" width="100px" height="100px" class="zdjecie">
</a>
Nazwa: ' . $produkt['tytul'] . '
     <br>
Opis:' . $produkt['opis'] . '
      <br>
Cena:' . $produkt['cena_bez'] . ' zł
       <br>
Ilość:' . $produkt['ilosc'] . ' 
<br>
Ocena:
';
    if($produkt['ocena']==null)
    {
        echo'Brak wystawionych ocen';
    }else
    {
        echo ''. number_format($produkt['ocena'],2) . '/5';
    }
    echo'    </div>';
}
?>
<form method="post" >
    <?php

        echo'
<b>
        DODAJ PRODUKT:
        </b>
    <input name="tytul" required placeholder="tytul">
    <input name="zdjecie" required placeholder="zdjecie">
    <input name="cena_bez" required placeholder="cena_bez">
    <input name="cena_z" required placeholder="cena_z">
    <input name="opis" required placeholder="opis">
    <input name="ilosc" required placeholder="ilosc">
    <input name="opisDuzy" required placeholder="opisDuzy">
    <input name="rodzaj" required placeholder="rodzaj">
    <input type="submit" name="dodaj" value="Dodaj">
    ';
        if(!empty($_POST['dodaj'])) {

            $t=$_POST['tytul'];
            $db=mysqli_select_db($conn,'projekt');
            $zapytanie = "SELECT * from produkty where tytul='$t'";
            $wynik = mysqli_query($conn,$zapytanie);
            $liczba=mysqli_num_rows($wynik);
            if($liczba>0)
            {

            }else{
                $p = new produkt($_POST['tytul'], $_POST['zdjecie'], $_POST['cena_bez'], $_POST['cena_z'], $_POST['opis'], $_POST['ilosc'], $_POST['opisDuzy'], $_POST['rodzaj']);
                $p->Dodaj();
                header("Location: indexa.php");

            }
    }
    ?>
</form>
</body>
</html>
