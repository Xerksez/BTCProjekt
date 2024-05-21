<?php
session_start();
include 'config.php';
    $id=$_GET['id'];
    $db=mysqli_select_db($conn,"projekt");
    $query2= "DELETE from opinia where id_produktu = '$id'";
    $conn->query($query2);
    $query = "DELETE from produkty where id = '$id'";
    $conn->query($query);
    header("Location:indexa.php");

