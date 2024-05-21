<?php
session_start();
$id=$_GET['id'];
include 'config.php';
$uzy= "SELECT * FROM uzytkownik where id='$id'";
$select = mysqli_query($conn,$uzy);
$uzy= mysqli_fetch_assoc($select);
if(isset($_POST['edytuj']))
{
    $h= mysqli_real_escape_string($conn, md5($_POST['h']));

    $query = "update uzytkownik set haslo='$h' where id='$id'";
    $conn->query($query);
    header("Location:kontoa.php?id=$id");
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
    <a href="indexa.php">
        <img class="image" style="float: left" src =i.png>
    </a>
    <?php
    echo'
  <a href="edytowanie3a.php?id='.$id.'"><b>Powrót</b></a>
    <form method="post">
<input type="text" required name="h" placeholder="nowe haslo">
<input type="submit" name="edytuj" >

    ';
    ?>
    </body>
    </html>

