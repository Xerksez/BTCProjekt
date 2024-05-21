<?php
session_start();
include 'config.php';
$ido=$_GET['ido'];
$id=$_GET['id'];
$db=mysqli_select_db($conn,"projekt");
$query = "DELETE from opinia where id = '$ido'";
$conn->query($query);
header("Location:szczegolya.php?&id=$id");

