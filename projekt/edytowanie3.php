<?php
session_start();
$id=$_GET['id'];
include 'config.php';
$uzy= "SELECT * FROM uzytkownik where id='$id'";
$select = mysqli_query($conn,$uzy);
$uzy= mysqli_fetch_assoc($select);
if(isset($_POST['edytuj']))
{
    if(filter_var($_POST['e'], FILTER_VALIDATE_EMAIL))
{
    $n=$_POST['n'];
    $e=$_POST['e'];
    $query = "update uzytkownik set nazwa='$n',email='$e' where id='$id'";
    $conn->query($query);
    header("Location:konto.php?id=$id");
}else
{
echo'<script>alert("Podany zły email") </script>';
}
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


<?php
echo'
<a href="index.php">
<img class="image" style="float: left" src =i.png>
</a>
<b>
<a href="konto.php?id='.$id.'">Powrót</a>
</b>

    <form method="post">
<input type="text" name="n" placeholder="nazwa" value="'.$uzy['nazwa'].'">
<input type="text" name="e" placeholder="email" value="'.$uzy['email'].'">



<input type="submit" name="edytuj" >
</form>
<br>
<a href="zmiana_hasla.php?id='.$id.'"><b>zmien haslo</b></a> 
    ';
?>
</body>
</html>
