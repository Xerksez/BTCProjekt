<?php
session_start();
include 'config.php';
$id=$_SESSION['id'];

$uzy = "SELECT nazwa from uzytkownik where id='$id'";
$select2 = mysqli_query($conn,$uzy);
$ok=0;
if(empty($_SESSION['id'])) {
    $_SESSION['id'] = 0;
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
    <?php
echo'
<a href="index.php">
<img class="image" style="float: left" src =i.png>
</a>
  <h1>
 ';
if(!empty($_SESSION['id']))
{
echo'
      <a href="konto.php">Moje konto</a>
      <a href="koszyk.php">Mój koszyk</a>
      ';
}
echo'
      
  </h1>
 ';
    $uzy= mysqli_fetch_assoc($select2);
    if(!empty($_SESSION['id'])){
   echo'<h2>Zalogowano jako: '.$uzy['nazwa'].'</h2><a href="wyloguj.php"><h3>Wyloguj</h3></a>';
    }
    else
    {
        echo'<h2><a href='."login.php".'>Zaloguj</a> </h2>
 <br> <br>
  <br> <br>' .
            '';

    }
    ?>
</header>
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
    <input type="text" name="cenaod" pattern="\d+" placeholder="od">
    cena do:
    <input type="text" name="cenado" pattern="\d+" placeholder="do">
    <input type="submit" name="filtr">
</form>
</div>

<br>
<?php
if(empty($_POST['filtr']))
{
    $produkt= "SELECT * FROM produkty order by tytul";
    $select = mysqli_query($conn,$produkt);

}else{
    if($_POST['rodzaj']=="wszystko"&&$_POST['cena']=="rosnaco")
    {
        if($_POST['cenaod']==null||$_POST['cenado']==null)
        {
            $produkt= "SELECT * FROM produkty order by cena_bez asc";
            $select = mysqli_query($conn,$produkt);
        }else
        {
            $co=$_POST['cenaod'];
            $cd=$_POST['cenado'];
            $produkt= "SELECT *FROM produkty where cena_bez BETWEEN '$co' and '$cd' order by cena_bez asc ";
            $select = mysqli_query($conn,$produkt);
        }

    }elseif($_POST['rodzaj']=="zabawki"&&$_POST['cena']=="rosnaco"){
        if($_POST['cenaod']==null||$_POST['cenado']==null)
        {
            $z="zabawka";
            $produkt= "SELECT * FROM produkty where rodzaj='$z' order by cena_bez asc ";
            $select = mysqli_query($conn,$produkt);
        }else
        {
            $z="zabawka";
            $co=$_POST['cenaod'];
            $cd=$_POST['cenado'];
            $produkt= "SELECT * FROM produkty where rodzaj='$z' and cena_bez BETWEEN '$co' and '$cd' order by cena_bez asc ";
            $select = mysqli_query($conn,$produkt);
        }

    }elseif($_POST['rodzaj']=="jedzenie"&&$_POST['cena']=="rosnaco"){
        if($_POST['cenaod']==null||$_POST['cenado']==null)
        {
        $j="jedzenie";
        $produkt= "SELECT * FROM produkty where rodzaj='$j' order by cena_bez asc";
        $select = mysqli_query($conn,$produkt);
        }else
        {
            $j="jedzenie";
            $co=$_POST['cenaod'];
            $cd=$_POST['cenado'];
            $produkt= "SELECT * FROM produkty where rodzaj='$j' and cena_bez BETWEEN '$co' and '$cd' order by cena_bez asc ";
            $select = mysqli_query($conn,$produkt);
        }

    }elseif($_POST['rodzaj']=="wszystko"&&$_POST['cena']=="malejaco")
    {
        if($_POST['cenaod']==null||$_POST['cenado']==null)
        {
            $produkt= "SELECT * FROM produkty order by cena_bez desc";
            $select = mysqli_query($conn,$produkt);
        }else
        {
            $co=$_POST['cenaod'];
            $cd=$_POST['cenado'];
            $produkt= "SELECT * FROM produkty where cena_bez BETWEEN '$co' and '$cd' order by cena_bez desc ";
            $select = mysqli_query($conn,$produkt);
        }


    }elseif($_POST['rodzaj']=="zabawki"&&$_POST['cena']=="malejaco") {
        if($_POST['cenaod']==null||$_POST['cenado']==null)
        {
            $z = "zabawka";
            $produkt = "SELECT * FROM produkty where rodzaj='$z order by cena_bez desc'";
            $select = mysqli_query($conn, $produkt);
        }else
        {
            $z="zabawka";
            $co=$_POST['cenaod'];
            $cd=$_POST['cenado'];
            $produkt= "SELECT * FROM produkty where rodzaj='$z' and cena_bez BETWEEN '$co' and '$cd' order by cena_bez desc ";
            $select = mysqli_query($conn,$produkt);
        }


    }elseif($_POST['rodzaj']=="jedzenie"&&$_POST['cena']=="malejaco"){
        if($_POST['cenaod']==null||$_POST['cenado']==null)
        {
            $j="jedzenie";
            $produkt= "SELECT * FROM produkty where rodzaj='$j' order by cena_bez desc";
            $select = mysqli_query($conn,$produkt);
        }else
        {
            $j="jedzenie";
            $co=$_POST['cenaod'];
            $cd=$_POST['cenado'];
            $produkt= "SELECT * FROM produkty where rodzaj='$j' and cena_bez BETWEEN '$co' and '$cd' order by cena_bez desc";
            $select = mysqli_query($conn,$produkt);
        }

    }elseif($_POST['rodzaj']=="porcelana"&&$_POST['cena']=="rosnaco") {
        if ($_POST['cenaod'] == null || $_POST['cenado'] == null) {

            $p = "porcelana";
            $produkt = "SELECT * FROM produkty where rodzaj='$p' order by cena_bez asc";
            $select = mysqli_query($conn, $produkt);
        } else {
            $p = "porcelana";
            $co = $_POST['cenaod'];
            $cd = $_POST['cenado'];
            $produkt = "SELECT * FROM produkty where rodzaj='$p' and cena_bez BETWEEN '$co' and '$cd' order by cena_bez asc ";
            $select = mysqli_query($conn, $produkt);
        }

    }elseif($_POST['rodzaj']=="porcelana"&&$_POST['cena']=="malejaco") {
        if ($_POST['cenaod'] == null || $_POST['cenado'] == null) {
            $p = "porcelana";
            $produkt = "SELECT * FROM produkty where rodzaj='$p' order by cena_bez desc";
            $select = mysqli_query($conn, $produkt);
        } else {
            $p = "porcelana";
            $co = $_POST['cenaod'];
            $cd = $_POST['cenado'];
            $produkt = "SELECT * FROM produkty where rodzaj='$p' and cena_bez BETWEEN '$co' and '$cd' order by cena_bez desc";
            $select = mysqli_query($conn, $produkt);
        }
    }elseif($_POST['rodzaj']=="ubranie"&&$_POST['cena']=="rosnaco") {
        if ($_POST['cenaod'] == null || $_POST['cenado'] == null) {

            $u = "ubranie";
            $produkt = "SELECT * FROM produkty where rodzaj='$u' order by cena_bez asc";
            $select = mysqli_query($conn, $produkt);
        } else {
            $u = "ubranie";
            $co = $_POST['cenaod'];
            $cd = $_POST['cenado'];
            $produkt = "SELECT * FROM produkty where rodzaj='$u' and cena_bez BETWEEN '$co' and '$cd' order by cena_bez asc ";
            $select = mysqli_query($conn, $produkt);
        }

    }elseif($_POST['rodzaj']=="ubranie"&&$_POST['cena']=="malejaco") {
        if ($_POST['cenaod'] == null || $_POST['cenado'] == null) {
            $u = "ubranie";
            $produkt = "SELECT * FROM produkty where rodzaj='$u' order by cena_bez desc";
            $select = mysqli_query($conn, $produkt);
        } else {
            $u = "ubranie";
            $co = $_POST['cenaod'];
            $cd = $_POST['cenado'];
            $produkt = "SELECT * FROM produkty where rodzaj='$u' and cena_bez BETWEEN '$co' and '$cd' order by cena_bez desc";
            $select = mysqli_query($conn, $produkt);
        }
    }
}

while($rzad = mysqli_fetch_assoc($select)) {

echo' <div class="produkt">
<a href="szczegoly.php?id= ' . $rzad['id'] . '">
     <img src="' . $rzad['zdjecie'] . '" width="100px" height="100px" class="zdjecie">
</a>
Nazwa: ' . $rzad['tytul'] . '
     <br>
Opis:' . $rzad['opis'] . '
      <br>
Cena:' . $rzad['cena_bez'] . ' zł
       <br>
Ilość:' . $rzad['ilosc'] . ' 
<br>
Ocena:
  ';
    if($rzad['ocena']==null)
    {
        echo'Brak wystawionych ocen';
    }else

        echo ''. number_format($rzad['ocena'],2) . '/5';
    if (!empty($_SESSION['id'])) {
       echo'
<form method="post" action="index.php?action=add&id= ' . $rzad['id'] . '">
<div class="prawo">
 <input type="text" name="ilosc" class="form-control" style="width: 200px"pattern="\d+" value="1">
    <input type="hidden" name="iloscc" class="form-control" id="example1" value=" ' . $rzad['ilosc'] . '">
    <input type="hidden" name="id" value=" ' . $rzad['id'] . '">
    <input type="hidden" name="ukrytytytul"value=" ' . $rzad['tytul'] . '">
    <input type="hidden" name="ukrytacenabez"value="' . $rzad['cena_bez'] . '">
    <input type="hidden" name="ukrytacenaz"value="' . $rzad['cena_z'] . '">
    <input type="submit" style="margin-right: auto" name="dodaj_do_koszyka" class="btn btn-success" value="Dodaj do koszyka">
    </div>
</form>

';
    }
    echo'</div>';
}
if(isset($_POST['dodaj_do_koszyka']))
{   $i=$_POST['ilosc'];
    $ilosc=$_POST['iloscc'];
    $idp=$_POST['id'];

        if(isset($_SESSION['koszyk']))
    {

        $id_produktu_tablica=array_column($_SESSION['koszyk'],'id');
        if(!in_array($_GET['id'], $id_produktu_tablica)&&$i<=$ilosc)
        {
            if($i<=$ilosc)
        {
            $query = "UPDATE produkty SET ilosc=ilosc -'$i' WHERE id='$idp'";
            $conn->query($query);
            }elseif($i>$ilosc)
            {
                echo '<script> alert("Nie ma tyle produktów!")</script>';
            }

            $liczba=count($_SESSION['koszyk']);
            $produkt_tablica = array(

                'id'                   => $_GET['id'],
                'tytul'                => $_POST['ukrytytytul'],
                'cena_bez'             => $_POST['ukrytacenabez'],
                'cena_z'               => $_POST['ukrytacenaz'],
                'ilosc'                => $_POST['ilosc']
            );
            $_SESSION['koszyk'][$liczba]=$produkt_tablica;
        }else
        {

            echo '<script> alert("Produkt został już dodany!")</script>';
            echo '<script> window.location="koszyk.php"</script>';
        }
    }else
    { if($i<=$ilosc)
    {
        $query = "UPDATE produkty SET ilosc=ilosc -'$i' WHERE id='$idp'";
        $conn->query($query);
    }elseif($i>$ilosc)
    {
        echo '<script> alert("Nie ma tyle produktów!")</script>';
    }
        $produkt_tablica = array(

            'id'                   => $_GET['id'],
            'tytul'                => $_POST['ukrytytytul'],
            'cena_bez'             => $_POST['ukrytacenabez'],
            'cena_z'               => $_POST['ukrytacenaz'],
            'ilosc'                => $_POST['ilosc']
        );
        $_SESSION['koszyk'][0]=$produkt_tablica;
    }
}

?>

</body>
</html>
