<?php
session_start();
include 'config.php';
$ido=$_GET['ido'];
$id=$_GET['id'];
$db=mysqli_select_db($conn,"projekt");
$query = "DELETE from opinia where id = '$ido'";

$srednia= "SELECT AVG(ocena) as srednia FROM opinia where id_produktu='$id'";
$select5 = mysqli_query($conn,$srednia);
$srednia = mysqli_fetch_assoc($select5);
$s= $srednia['srednia'];


$query2 = "Update produkty set ocena='$s', ilosc_ocen=ilosc_ocen-1 where id= '$id'";
$conn->query($query2);

$produkt= "SELECT * FROM produkty where id='$id'";
$select = mysqli_query($conn,$produkt);
$produkt = mysqli_fetch_assoc($select);
if($produkt['ilosc_ocen']==0)
{
    $query3="  UPDATE `produkty` SET `ocena` =NULL where id ='$id'";
    $conn->query($query3);
}
$conn->query($query);

header("Location:szczegoly.php?&id=$id");

