<?php
session_start();
$id=$_GET['id'];
$ido=$_GET['ido'];
include 'config.php';
$produkt= "SELECT * FROM opinia join uzytkownik on uzytkownik.id=opinia.id_uzytkownika where id_produktu='$id'";
$select = mysqli_query($conn,$produkt);
$produkt = mysqli_fetch_assoc($select);

$opinia= "SELECT * FROM opinia where id_produktu='$id' ";
$select2 = mysqli_query($conn,$opinia);
$opinia= mysqli_fetch_assoc($select2);
if(isset($_POST['edytuj']))
{

    if($_POST['o']<=5)
    {

        $t = $_POST['t'];
        $o = $_POST['o'];
        $query = "update opinia set tekst='$t',ocena='$o' where opinia.id='$ido'";
        $conn->query($query);
        header("Location:szczegoly.php?id=$id");

    }else{
    echo'<script>alert("Ocena powinna być w zakresie 1-5")</script>';
    }

}
?>
<html>
<head>
    <link rel="stylesheet" href="css.css">
    <link rel="shortcut icon" href=favicon.ico>
</head>
<body>
<a href="index.php">
    <img class="image" style="float: left" src =i.png>
</a>
<?php

$t=$produkt['tekst'];
$o=$produkt['ocena'];
    echo'
    <form method="post">
   
<input type="text" name="t" value="'.$t.'">
<input type="text" max="5" pattern="\d+"  name="o" value="'.$o.'">
<input type="submit" name="edytuj" >
</form>
    ';
?>
</body>
</html>
