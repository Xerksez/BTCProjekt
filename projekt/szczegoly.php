
<?php
session_start();
include 'config.php';

spl_autoload_register(function ($opinia) {
    include $opinia . '.php';
});
$idu=$_SESSION['id'];
$id=$_GET['id'];

$produkt= "SELECT * FROM produkty where produkty.id='$id'";
$select = mysqli_query($conn,$produkt);

$produkt2= "SELECT * FROM opinia join uzytkownik on uzytkownik.id=opinia.id_uzytkownika where id_produktu='$id'";
$select2 = mysqli_query($conn,$produkt2);



$produkt3= "SELECT * FROM opinia where id_produktu='$id'and id_uzytkownika='$idu'";
$select3 = mysqli_query($conn,$produkt3);
$produkt3 = mysqli_fetch_assoc($select3);

$ido=$produkt3['id'];


if(empty($_SESSION['id'])) {
    $_SESSION['id'] = 0;
}



?>
<html>
<head>

    <link rel="stylesheet" href="/path/to/cdn/font-awesome.min.css" />
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
<a href="index.php">
    <img class="image" style="float: left" src =i.png>
</a>
<?php

while($produkt = mysqli_fetch_assoc($select)) {
    echo '
    <div class ="produkt" style="height: 250px">
<img src="' . $produkt['zdjecie'] . '" width="100px" height="100px" class="zdjecie">
Nazwa:  ' . $produkt['tytul'] . '
<br>
Opis:  ' . $produkt['opis'] . '
<br>
Cena bez dostawy:   ' . $produkt['cena_bez'] . '
<br>
Ilość: ' . $produkt['ilosc'] . ' 
<br>
Więcej informacji: ' . $produkt['opisDuzy'] . ' <br>'
    ;

  if($produkt['ocena']==null)
    {
        echo'Brak wystawionych ocen';
    }else
        echo ' Ocena: '. number_format($produkt['ocena'],2) . '';

    $ilosc=$produkt['ilosc'];

    if(!empty($_SESSION['id'])) {

        echo '
<form method="post" action="szczegoly.php?action=add&id= ' . $produkt['id'] . '">
    <input type="text" name="ilosc" pattern="\d" class="form-control" value="1">
    <input type="hidden" name="ukrytytytul"value=" ' . $produkt['tytul'] . '">
    <input type="hidden" name="ukrytacenabez"value="' . $produkt['cena_bez'] . '">
    <input type="hidden" name="ukrytacenaz"value="' . $produkt['cena_z'] . '">
   
    <input type="submit" name="dodaj_do_koszyka" class="btn btn-success" value="Dodaj do koszyka">
';
    }
    ?>
    </form>

    <?php
    echo'</div >';
    if($_SESSION['id']!=0)
    {
        echo'
<form method="post">
<b>
Dodaj opinie:
<input type="text" name="opinia">
<br>
Oceń od 1 do 5:
<input type="text" required  pattern="\d+" name="ocena">/5
<input type="submit" name="dodaj" value="Dodaj opinie">
</b>
</form>
';
    }

}

while($produkt2 = mysqli_fetch_assoc($select2)) {

    $n=$produkt2['nazwa'];

    echo'
    <br>
       <form method="post">
    <input type="text" disabled name="nazwa"  value="'.$n.'" >
    <input type="hidden" name="id" value="'.$ido.'" >
   <textarea   name="tekst" disabled >'.$produkt2['tekst'].'</textarea>
    <input type="text" name="ocena" disabled value="'.$produkt2['ocena'] .'/5" >
    ';
    ?>
    <?php
    if($produkt2['id_uzytkownika']==$idu)
    {
        echo'  
    
    <a href="edytowanie2.php?id='.$_GET['id'].'&ido='.$ido.'" class="btn btn-success" >edytuj</a>
    <a href="usuwanie3.php?id='.$_GET['id'].'&ido='.$ido.'" class="btn btn-success" >usuń</a>
 </form>  
 
    ';
    }
    echo'
</form>
</div >
    
';

}


if(!empty($_POST['dodaj']))
{
    if($_POST['ocena']<=5)
    {
    $id=$_GET['id'];
    $idu=$_SESSION['id'];
    $db=mysqli_select_db($conn,'projekt');
    $zapytanie = "SELECT uzytkownik.id from uzytkownik join opinia on uzytkownik.id=opinia.id_uzytkownika where uzytkownik.id='$idu' and id_produktu='$id'";
    $wynik = mysqli_query($conn,$zapytanie);
    $liczba=mysqli_num_rows($wynik);

    if($liczba>0)
    {
    }else{

        $query = "Update produkty set ilosc_ocen=ilosc_ocen+1 where id='$id'";
        $conn->query($query);
        $o = new opinia($idu, $id, $_POST['ocena'], $_POST['opinia']);
        $o->Dodaj();
        $srednia= "SELECT AVG(ocena) as srednia FROM opinia where id_produktu='$id'";
        $select5 = mysqli_query($conn,$srednia);
        $srednia = mysqli_fetch_assoc($select5);
         $s= $srednia['srednia'];
        $query = "Update produkty set ocena='$s' where id= '$id'";
        $conn->query($query);

        header("Location:szczegoly.php?action=&id=$id");

    }
    }else
    {
        echo'<script>alert("Ocena powinna być w zakresie 1-5")</script>';
    }
}

if(isset($_POST['dodaj_do_koszyka']))
{
        if(isset($_SESSION['koszyk']))
        {
            $id_produktu_tablica=array_column($_SESSION['koszyk'],'id');
            if(!in_array($_GET['id'], $id_produktu_tablica))
            {
                if($_POST['ilosc']<=$ilosc)
                {
                    $i=$_POST['ilosc'];
                    $query = "UPDATE produkty SET ilosc=ilosc -'$i' WHERE id='$id'";
                    $conn->query($query);
                }elseif($_POST['ilosc']>$ilosc)
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
                echo '<script> window.location="koszyk.php"</script>';
            }else
            {

                echo '<script> alert("Produkt został już dodany!")</script>';
                 echo '<script> window.location="koszyk.php"</script>';

            }
        }else
        {
            $produkt_tablica = array(

                'id'                   => $_GET['id'],
                'tytul'                => $_POST['ukrytytytul'],
                'cena_bez'             => $_POST['ukrytacenabez'],
                'cena_z'               => $_POST['ukrytacenaz'],
                'ilosc'                => $_POST['ilosc']
            );
            $_SESSION['koszyk'][0]=$produkt_tablica;
            if($_POST['ilosc']<=$ilosc)
            {
                $i=$_POST['ilosc'];
                $query = "UPDATE produkty SET ilosc=ilosc -'$i' WHERE id='$id'";
                $conn->query($query);
            }elseif($_POST['ilosc']>$ilosc)
            {
                echo '<script> alert("Nie ma tyle produktów!")</script>';
            }
            echo '<script> window.location="koszyk.php"</script>';
        }

}
?>



</body>
</html>
